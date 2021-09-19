<?php

namespace App\Http\Controllers;

use App\Services\Contracts\PaymentGatewayContract;
use Illuminate\Http\Request;

class PaymentHookController extends Controller
{

    protected $paymentGateway;

    public function __construct(PaymentGatewayContract $paymentGatewayContract)
    {
        $this->paymentGateway = $paymentGatewayContract;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            $this->paymentGateway->updateInvoiceStatus($request);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e->getMessage()], 400);
        }
    }
}
