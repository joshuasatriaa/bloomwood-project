<?php

namespace App\Models;

use App\Traits\FilterTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class AddressArea extends Model
{
    use HasFactory;
    use FilterTrait;

    protected $collection = 'address_areas';
    public $timestamps = false;

    protected $fillable = [
        'province',
        'city',
        'district',
        'urban',
        'postal_code',
        'small_price',
        'medium_price'
    ];
}
