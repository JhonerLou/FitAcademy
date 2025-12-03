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

        $this->clientId = trim('BRN-0217-1764762663545');
        $this->secretKey = trim('SK-DVabJbyKBzIQtPGM4Hwn');
        $this->baseUrl = 'https://api-sandbox.doku.com';
    }


    public function show(Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id() || $transaction->status !== 'pending') {
            return redirect()->route('member.shop');
        }

        $requestId = Str::uuid()->toString();
        $targetPath = '/checkout/v1/payment';
        $timestamp = gmdate('Y-m-d\TH:i:s\Z');

        $payload = [
            'order' => [
                'amount' => (int) $transaction->total_amount,
                'invoice_number' => 'INV-' . time() . '-' . $transaction->id,
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
            ]
        ];


        $signature = $this->generateSignature($payload, $timestamp, $requestId, $targetPath);


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


        if ($response->successful()) {
            $paymentUrl = $response->json()['response']['payment']['url'];


            $transaction->status = 'pending';
            $transaction->save();

            return redirect()->away($paymentUrl);
        }

        $errorBody = $response->json();


        return redirect()->back()->with('error', 'Payment Gateway Error: ' . ($errorBody['error']['message'] ?? 'Unknown Error'));
    }


    public function process(Request $request)
    {

        $clientId = $request->header('Client-Id');


        if ($clientId !== $this->clientId) {
            return response()->json(['message' => 'Invalid Client ID'], 401);
        }

        $notificationBody = $request->json()->all();
        $invoiceNumber = $notificationBody['order']['invoice_number'] ?? null;
        $transactionStatus = $notificationBody['transaction']['status'] ?? null;

        if ($invoiceNumber && $transactionStatus === 'SUCCESS') {

            $parts = explode('-', $invoiceNumber);
            $transactionId = end($parts); // Get the last part

            $transaction = Transaction::find($transactionId);

            if ($transaction && $transaction->status !== 'completed') {

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
        }

        return response()->json(['message' => 'OK']);
    }

      public function success(Transaction $transaction): View
    {
        return view('payment.success', compact('transaction'));
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
