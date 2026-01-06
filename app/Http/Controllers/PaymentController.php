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
        $this->clientId = trim(env('DOKU_CLIENT_ID'));
        $this->secretKey = trim(env('DOKU_SECRET_KEY'));
        $this->baseUrl = trim(env('DOKU_BASE_URL'));
    }

    public function show(Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id() || $transaction->status !== 'pending') {
            return redirect()->route('member.shop');
        }

        if (empty($this->clientId)) {
            return redirect()->back()->with('error', 'Configuration Error: Doku Client ID is missing.');
        }

        $requestId = Str::uuid()->toString();
        $targetPath = '/checkout/v1/payment';
        $timestamp = gmdate('Y-m-d\TH:i:s\Z');

        $invoiceNumber = 'INV-' . $transaction->id . '-' . time();
        $notifyUrl = 'https://jhonerlou.com/payment/notify';

        $payload = [
            'order' => [
                'amount' => (int) $transaction->total_amount,
                'invoice_number' => $invoiceNumber,
                'currency' => 'IDR',
                'callback_url' => route('payment.success', $transaction),
                'failed_url' => route('member.shop'),
            ],
            'payment' => [
                'payment_due_date' => 60
            ],
            'customer' => [
                'name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
            'notification_url' => $notifyUrl,
        ];

        $signature = $this->generateSignature($payload, $timestamp, $requestId, $targetPath);

        try {
            $response = Http::withHeaders([
                'Client-Id' => $this->clientId,
                'Request-Id' => $requestId,
                'Request-Timestamp' => $timestamp,
                'Signature' => $signature,
            ])->post($this->baseUrl . $targetPath, $payload);

            if ($response->successful()) {
                $paymentUrl = $response->json()['response']['payment']['url'];
                $transaction->note = $invoiceNumber;
                $transaction->save();
                return redirect()->away($paymentUrl);
            }

            Log::error('Doku Payment Error', ['body' => $response->body()]);
            return redirect()->back()->with('error', 'Payment Gateway Error: ' . $response->body());

        } catch (\Exception $e) {
            Log::error('Doku Connection Exception', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Connection Error');
        }
    }

    public function process(Request $request)
    {
        Log::info('Doku Webhook Hit', $request->all());


        $clientIdHeader = $request->header('Client-Id');
        if ($clientIdHeader !== $this->clientId) {
            Log::warning("Webhook Client ID mismatch: $clientIdHeader vs {$this->clientId}");
        }

        $notificationBody = $request->json()->all();
        $invoiceNumber = $notificationBody['order']['invoice_number'] ?? null;
        $transactionStatus = $notificationBody['transaction']['status'] ?? null;

        if ($invoiceNumber && $transactionStatus === 'SUCCESS') {
            $this->completeTransactionFromInvoice($invoiceNumber);
        }

        return response()->json(['message' => 'OK']);
    }

    public function success(Transaction $transaction): View
    {

        if ($transaction->status === 'pending' && $transaction->note) {
            $this->checkStatusDirectly($transaction);
        }

        return view('payment.success', compact('transaction'));
    }


    private function checkStatusDirectly(Transaction $transaction)
    {
        $requestId = Str::uuid()->toString();

        $targetPath = '/orders/v1/status/' . $transaction->note;
        $timestamp = gmdate('Y-m-d\TH:i:s\Z');


        $rawSignature = "Client-Id:" . $this->clientId . "\n" .
                        "Request-Id:" . $requestId . "\n" .
                        "Request-Timestamp:" . $timestamp . "\n" .
                        "Request-Target:" . $targetPath; 

        $signature = "HMACSHA256=" . base64_encode(hash_hmac('sha256', $rawSignature, $this->secretKey, true));

        try {
            $response = Http::withHeaders([
                'Client-Id' => $this->clientId,
                'Request-Id' => $requestId,
                'Request-Timestamp' => $timestamp,
                'Signature' => $signature,
            ])->get($this->baseUrl . $targetPath);

            if ($response->successful()) {
                $status = $response->json()['transaction']['status'] ?? null;
                if ($status === 'SUCCESS') {
                    $this->completeOrder($transaction);
                }
            }
        } catch (\Exception $e) {
            Log::error("Manual Status Check Failed: " . $e->getMessage());
        }
    }

    private function completeTransactionFromInvoice($invoiceNumber)
    {
        // Extract ID from "INV-{ID}-{TIME}"
        $parts = explode('-', $invoiceNumber);
        $transactionId = $parts[1] ?? null;

        if ($transactionId) {
            $transaction = Transaction::find($transactionId);
            if ($transaction && $transaction->status !== 'completed') {
                $this->completeOrder($transaction);
                Log::info("Transaction #{$transactionId} completed via logic.");
            }
        }
    }

    private function completeOrder(Transaction $transaction)
    {
        $transaction->update([
            'status' => 'completed',
            'updated_at' => now(),
        ]);

        foreach ($transaction->items as $item) {
            $product = Product::find($item->product_id);
            if ($product && $product->stock >= $item->quantity) {
                $product->decrement('stock', $item->quantity);
            }
        }
    }

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
