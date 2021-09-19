<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\InvoicePayment;
use App\Services\Contracts\PaymentGatewayContract;
use Illuminate\Http\Request;
use Midtrans\Config as MidtransConfig;

class MidtransService implements PaymentGatewayContract
{
    protected $serverKey;
    protected $isProduction;
    protected $isSanitized;
    protected $is3ds;

    protected $invoiceId;
    protected $grossAmount;
    protected $customer;

    protected $notification;

    public function __construct()
    {
        $this->serverKey = config('app.midtrans_server_key');
        $this->isProduction = config('app.middtrans_production');
        $this->isSanitized = true;
        $this->is3ds = true;
    }

    public function setInvoiceId(string $id): PaymentGatewayContract
    {
        $this->invoiceId = $id;

        return $this;
    }

    public function setGrossAmount(int $amount): PaymentGatewayContract
    {
        $this->grossAmount = $amount;

        return $this;
    }

    public function setCustomerDetail(string $name, string $email, string $phoneNumber): PaymentGatewayContract
    {
        $this->customer = [
            'first_name' => $name,
            'email' => $email,
            'phone' => $phoneNumber
        ];

        return $this;
    }


    public function getToken(): string
    {
        // Set your Merchant Server Key
        MidtransConfig::$serverKey = $this->serverKey;
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        MidtransConfig::$isProduction = $this->isProduction;
        // Set sanitization on (default)
        MidtransConfig::$isSanitized = $this->isSanitized;
        // Set 3DS transaction for credit card to true
        MidtransConfig::$is3ds = $this->is3ds;

        $snapToken = \Midtrans\Snap::getSnapToken($this->generateInvoiceDetail());
        return $snapToken;
    }

    public function updateInvoiceStatus(Request $request)
    {
        MidtransConfig::$isProduction = $this->isProduction;
        MidtransConfig::$serverKey = $this->serverKey;
        $this->notification = new \Midtrans\Notification();
        $notif = $this->notification;

        $transactionStatus = $notif->transaction_status;
        $order_id = $notif->order_id;

        $invoice = Invoice::findOrFail($order_id);

        $payload = json_decode($request->getContent());
        $validSignatureKey = hash("sha512", $invoice->id . $payload->status_code . $invoice->grand_total . $this->serverKey);
        if ($payload->signature_key != $validSignatureKey) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $invoice->invoicePayment()->updateOrCreate(
            ['invoice_id' => $order_id],
            $payload
        );

        $invoice->status = $transactionStatus;
        $invoice->save();

        return true;
    }

    protected function generateInvoiceDetail(): array
    {
        $res = array(
            'transaction_details' => array(
                'order_id' => $this->invoiceId,
                'gross_amount' => $this->grossAmount,
            ),
            'customer_details' => $this->customer
        );

        return $res;
    }
}
