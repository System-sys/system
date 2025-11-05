<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
   use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'id_card',
        'email',
        'code',
        'registered',
        'account',
        'amount',
    ];
}
