<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class InvoicePayment extends Model
{
    use HasFactory;

    protected $collection = 'invoice_payments';

    protected $fillable = [
        "invoice_id",
        "transaction_time",
        "transaction_status",
        "transaction_id",
        "status_message",
        "status_code",
        "signature_key",
        "payment_type",
        "order_id",
        "merchant_id",
        "masked_card",
        "gross_amount",
        "fraud_status",
        "eci",
        "currency",
        "channel_response_message",
        "channel_response_code",
        "card_type",
        "bank",
        "approval_code"
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
