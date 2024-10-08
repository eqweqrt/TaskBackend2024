<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'products',
        'price'
    ];

    protected $table = 'cart_history';
}
