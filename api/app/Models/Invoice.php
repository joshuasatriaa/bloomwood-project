<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Jenssegers\Mongodb\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $collection = "invoices";

    protected $fillable = [
        'user_id',
        'invoice_number',
        'products_detail',
        /**
         * products_detail => [
         *      [
         *          'id',
         *          'name',
         *          'variant' => [
         *              'id',
         *              'name',
         *              'price'
         *          ]
         *          'add_ons' => [
         *              [
         *                  'id',
         *                  'name',
         *                  'price',
         *              ]   
         *          ],
         *          'total_price',
         *      ]
         * ]
         */
        'notes',
        'address',
        'grand_total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function generateInvoiceNumber(): string
    {
        return 'INV-' . Carbon::now()->format('dmy') . '-' . Carbon::now()->timestamp . '-' . Str::random(5);
    }
}
