<?php

namespace App\Modules\Account\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Account extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'email',
        'password',
    ];

    public function password() : Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return Hash::needsRehash($value)
                    ? Hash::make($value)
                    : $value;
            }
        );
    }
}
