<?php

namespace App\Http\Controllers;

use App\Facades\InvoiceFacade;
use App\Http\Requests\InvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Models\User;
use App\Services\Contracts\PaymentGatewayContract;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    protected $paymentGateway;

    public function __construct(PaymentGatewayContract $paymentGatewayContract)
    {
        $this->paymentGateway = $paymentGatewayContract;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userRole =  auth()->user()->role->slug;
        $admins = $userRole == 'superadmin' || $userRole == 'admin';

        $invoices = Invoice::query()->when(!$admins, function ($q) {
            return $q->own();
        })->latest()->paginate(30);

        return InvoiceResource::collection($invoices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\InvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {
        $user = auth()->user();
        $invoiceFacade = new InvoiceFacade(new InvoiceService(), $request->validated());
        $invoice = $invoiceFacade->generate();

        $token = $this->paymentGateway
            ->setInvoiceId($invoice->id)
            ->setGrossAmount($invoice->grand_total)
            ->setCustomerDetail($user->name, $user->email, $user->phone_number)
            ->getToken();

        $invoice->token = $token;

        return (new InvoiceResource($invoice))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $this->authorize('view', $invoice);

        return new InvoiceResource($invoice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
