<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    private $clientId;
    private $secretKey;
    private $baseUrl;

    public function __construct()
    {
        // 🔴 HARDCODED KEYS (To fix the error immediately)
        // We use trim() to remove any accidental spaces you might have copied
        $this->clientId = trim('BRN-0217-1764762663545');
        $this->secretKey = trim('SK-DVabJbyKBzIQtPGM4Hwn');
        $this->baseUrl = 'https://api-sandbox.doku.com';
    }

    /**
     * Step 1: Generate Payment URL and Redirect to Doku
     */
    public function show(Transaction $transaction)
    {
        // 1. Validation
        if ($transaction->user_id !== auth()->id() || $transaction->status !== 'pending') {
            return redirect()->route('member.shop');
        }

        // 2. Prepare Request Data
        $requestId = Str::uuid()->toString();
        $targetPath = '/checkout/v1/payment'; // Doku Jokul Checkout Path
        $timestamp = gmdate('Y-m-d\TH:i:s\Z'); // Must be UTC ISO8601

        $payload = [
            'order' => [
                'amount' => (int) $transaction->total_amount, // Ensure integer/number
                'invoice_number' => 'INV-' . time() . '-' . $transaction->id, // Unique Invoice
                'currency' => 'IDR',
                'callback_url' => route('payment.success', $transaction), // Redirect here after success
                'failed_url' => route('member.shop'), // Redirect here if failed
            ],
            'payment' => [
                'payment_due_date' => 60 // Order expires in 60 minutes
            ],
            'customer' => [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ]
        ];

        // 3. Generate Signature
        $signature = $this->generateSignature($payload, $timestamp, $requestId, $targetPath);

        // 4. Send Request to Doku API
        // We log the request to help debug if it fails again
        Log::info('Doku Request', [
            'url' => $this->baseUrl . $targetPath,
            'client_id' => $this->clientId,
            'signature' => $signature,
            'payload' => $payload
        ]);

        $response = Http::withHeaders([
            'Client-Id' => $this->clientId,
            'Request-Id' => $requestId,
            'Request-Timestamp' => $timestamp,
            'Signature' => $signature,
        ])->post($this->baseUrl . $targetPath, $payload);

        // 5. Handle Response
        if ($response->successful()) {
            $paymentUrl = $response->json()['response']['payment']['url'];

            // Save invoice number for verification later
            $transaction->status = 'pending'; // Ensure it's pending
            $transaction->save();

            return redirect()->away($paymentUrl);
        }

        // Error handling - Dump the error to screen so we can see exactly what Doku says
        $errorBody = $response->json();

        // Return back with error message
        return redirect()->back()->with('error', 'Payment Gateway Error: ' . ($errorBody['error']['message'] ?? 'Unknown Error'));
    }

    /**
     * Step 2: Handle Notification from Doku (Webhook)
     */
    public function process(Request $request)
    {
        // 1. Get Headers
        $clientId = $request->header('Client-Id');

        // Simple security check (in production use Signature verification)
        if ($clientId !== $this->clientId) {
            return response()->json(['message' => 'Invalid Client ID'], 401);
        }

        $notificationBody = $request->json()->all();
        $invoiceNumber = $notificationBody['order']['invoice_number'] ?? null;
        $transactionStatus = $notificationBody['transaction']['status'] ?? null;

        if ($invoiceNumber && $transactionStatus === 'SUCCESS') {
            // Extract Transaction ID from Invoice Number "INV-TIME-ID"
            $parts = explode('-', $invoiceNumber);
            $transactionId = end($parts); // Get the last part

            $transaction = Transaction::find($transactionId);

            if ($transaction && $transaction->status !== 'completed') {

                // Update Status
                $transaction->update([
                    'status' => 'completed',
                    'updated_at' => now(),
                ]);

                // Decrement Stock
                foreach ($transaction->items as $item) {
                    $product = Product::find($item->product_id);
                    if ($product && $product->stock >= $item->quantity) {
                        $product->decrement('stock', $item->quantity);
                    }
                }
            }
        }

        return response()->json(['message' => 'OK']);
    }

    /**
     * Step 3: Success Page (Redirect URL)
     */
    public function success(Transaction $transaction): View
    {
        return view('payment.success', compact('transaction'));
    }

    /**
     * Helper: Generate HMAC SHA256 Signature
     */
    private function generateSignature($payload, $timestamp, $requestId, $targetPath)
    {
        $digest = base64_encode(hash('sha256', json_encode($payload), true));
        $rawSignature = "Client-Id:" . $this->clientId . "\n" .
                        "Request-Id:" . $requestId . "\n" .
                        "Request-Timestamp:" . $timestamp . "\n" .
                        "Request-Target:" . $targetPath . "\n" .
                        "Digest:" . $digest;

        return "HMACSHA256=" . base64_encode(hash_hmac('sha256', $rawSignature, $this->secretKey, true));
    }
}
