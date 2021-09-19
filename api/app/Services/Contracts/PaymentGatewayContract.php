<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Http\Request;

interface PaymentGatewayContract
{
    public function getToken(): string;
    public function setInvoiceId(string $id): PaymentGatewayContract;
    public function setGrossAmount(int $amount): PaymentGatewayContract;
    public function setCustomerDetail(string $name, string $email, string $phoneNumber): PaymentGatewayContract;
    public function updateInvoiceStatus(Request $request): bool;
}
