<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $collection = 'contact_us';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'found_bloomwood',
        'message'
    ];
}
