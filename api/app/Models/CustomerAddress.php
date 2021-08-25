<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $collection = 'customer_addresses';

    protected $fillable = [
        'user_id',
        'address_area_id',
        'address',
    ];

    protected $with = [
        'addressArea'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addressArea()
    {
        return $this->belongsTo(AddressArea::class);
    }
}
