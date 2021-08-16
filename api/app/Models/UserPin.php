<?php

namespace App\Models;

use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Mongodb\Eloquent\Model;

class UserPin extends Model
{
    // use UuidTrait;
    use HasFactory;

    protected $table = 'user_pins';
    protected $fillable = [
        'user_id',
        'pin'
    ];

    protected $hidden = [
        'pin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setPinAttribute($pin)
    {
        $this->attributes['pin'] = Hash::make($pin);
    }
}
