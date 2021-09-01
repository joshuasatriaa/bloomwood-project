<?php

namespace App\Services\Contracts;

use App\Models\User;

interface PaymentGatewayContract
{
    public function getToken(): string;
    public function setInvoiceId(string $id): PaymentGatewayContract;
    public function setGrossAmount(int $amount): PaymentGatewayContract;
    public function setCustomerDetail(string $name, string $email, string $phoneNumber): PaymentGatewayContract;
}
