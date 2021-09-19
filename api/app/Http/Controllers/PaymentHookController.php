<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Services\Contracts\PaymentGatewayContract;
use Illuminate\Http\Request;
use Midtrans\Config as MidtransConfig;


class PaymentHookController extends Controller
{

    // protected $paymentGateway;

    // public function __construct(PaymentGatewayContract $paymentGatewayContract)
    // {
    //     $this->paymentGateway = $paymentGatewayContract;
    // }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // try {
        //     $this->paymentGateway->updateInvoiceStatus($request);
        // } catch (\Exception $e) {
        //     return response()->json(['errors' => $e->getMessage()], 400);
        // }
        MidtransConfig::$isProduction = config('app.middtrans_production');
        MidtransConfig::$serverKey = config('app.midtrans_server_key');

        $notif = new \Midtrans\Notification();

        $transactionStatus = $notif->transaction_status;
        $order_id = $notif->order_id;

        $invoice = Invoice::findOrFail($order_id);

        $payload = json_decode($request->getContent());
        $validSignatureKey = hash("sha512",  $payload->order_id . $payload->status_code . $payload->gross_amount . config('app.midtrans_server_key'));
        if ($payload->signature_key != $validSignatureKey) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // $invoice->invoicePayment()->updateOrCreate(
        //     ['invoice_id' => $order_id],
        //     (array) $notif
        // );

        $invoice->status = $transactionStatus;
        $invoice->save();

        return true;
    }
}
