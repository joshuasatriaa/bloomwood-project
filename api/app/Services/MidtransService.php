<?php

namespace App\Services;

use App\Services\Contracts\PaymentGatewayContract;
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
        // $this->user = $user;
        $this->customer = [
            'full_name' => $name,
            'email' => $email,
            'phone_number' => $phoneNumber
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
