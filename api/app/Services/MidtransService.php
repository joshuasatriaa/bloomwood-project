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
        $notif = new \Midtrans\Notification();

        $transactionStatus = $notif->transaction_status;
        $order_id = $notif->order_id;

        $invoice = Invoice::findOrFail($order_id);

        $payload = json_decode($request->getContent());
        $validSignatureKey = hash("sha512", $payload->order_id . $payload->status_code . $payload->gross_amount . $this->serverKey);
        if ($payload->signature_key != $validSignatureKey) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $invoice->status = $transactionStatus;
        $invoice->save();

        $data = [
            'invoice_id' => $invoice->id,
            "transaction_time" => $notif->transaction_time,
            "transaction_status" => $notif->transaction_status,
            "transaction_id" => $notif->transaction_id,
            "status_message" => $notif->status_message,
            "status_code" => $notif->status_code,
            "signature_key" => $notif->signature_key,
            "payment_type" => $notif->payment_type,
            "order_id" => $notif->order_id,
            "merchant_id" => $notif->merchant_id,
            "masked_card" => $notif->masked_card,
            "gross_amount" => $notif->gross_amount,
            "fraud_status" => $notif->fraud_status,
            "eci" => $notif->eci,
            "currency" => $notif->currency,
            "channel_response_message" => $notif->channel_response_message,
            "channel_response_code" => $notif->channel_response_code,
            "card_type" => $notif->card_type,
            "bank" => $notif->bank,
            "approval_code" => $notif->approval_code,
        ];

        if (!$invoice->invoicePayment()->exists()) {
            InvoicePayment::create($data);
        } else {
            $invoice->invoicePayment()->update($data);
        }

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
