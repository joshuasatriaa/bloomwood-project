<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Testimony extends Model
{
    use HasFactory;

    protected $collection = 'testimonies';

    protected $fillable = [
        'name',
        'message'
    ];
}
