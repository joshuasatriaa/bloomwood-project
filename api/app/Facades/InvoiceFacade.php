<?php

namespace App\Facades;

use App\Models\Invoice;
use App\Services\InvoiceService;
use Illuminate\Support\Facades\Auth;

class InvoiceFacade
{
    protected $invoiceService;
    protected $validatedRequest;
    protected $productsDetail;
    protected $deliveryFee;
    protected $addressArea;
    protected $grandTotal;

    public function __construct(InvoiceService $invoiceService, array $validatedRequest)
    {
        $this->invoiceService = $invoiceService;
        $this->validatedRequest = $validatedRequest;

        $this->addressArea = $this->getAddressArea();
        $this->productsDetail = $this->getProductsDetail();
        $this->deliveryFee = $this->getDeliveryFee();
        $this->grandTotal = $this->getGrandTotal();
    }

    public function generate(): Invoice
    {
        $invoice = new Invoice($this->validatedRequest);
        $invoice->user_id = Auth::id();
        $invoice->address_area = $this->addressArea;
        $invoice->products_detail = $this->productsDetail;
        $invoice->delivery_fee = $this->deliveryFee;
        $invoice->grand_total = $this->grandTotal;
        $invoice->save();

        return $invoice;
    }

    private function getAddressArea()
    {
        return $this->invoiceService->copyAddressAreaData($this->validatedRequest['address_area_id']);
    }

    private function getProductsDetail()
    {
        return $this->invoiceService->generateProductsDetail($this->validatedRequest['products']);
    }

    private function getDeliveryFee()
    {
        return $this->validatedRequest['pick_up'] ? 0 : $this->invoiceService->defineDeliverFee($this->productsDetail, $this->addressArea);
    }

    private function getGrandTotal()
    {
        return $this->invoiceService->calculateGrandTotal($this->productsDetail, $this->deliveryFee);
    }
}
