<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
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
         *              'price',
         *              'thumbnail_image
         *          ]
         *          'add_ons' => [
         *              [
         *                  'id',
         *                  'name',
         *                  'price',
         *                  'thumbnail_image
         *              ]   
         *          ],
         *          'message',
         *          'price',
         *          'total_price',
         *          'thumbnail_image
         *      ]
         * ]
         */
        'status', // [pending, paid, processed, delivered]
        'notes',
        'address',
        'address_area', // copy of AddressArea
        'pick_up',
        'delivery_fee',
        'grand_total',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($invoice) {
            $invoice->user_id = Auth::id();
            $invoice->status = 'pending';
            $invoice->invoice_number = self::generateInvoiceNumber();
        });
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function generateInvoiceNumber(): string
    {
        return 'INV-' . Carbon::now()->format('dmy') . '-' . Carbon::now()->timestamp . '-' . Str::random(5);
    }

    public function scopeOwn($query)
    {
        return $query->where('user_id', Auth::id());
    }
}
