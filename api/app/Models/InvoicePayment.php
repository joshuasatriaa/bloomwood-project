<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class InvoicePayment extends Model
{
    use HasFactory;

    protected $collection = 'invoice_payments';

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
