<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;

    protected $fillable = [
        'customerID',
        'paymentID',
        'productID',
        'product',
        'quantity',
        'payment',
        'total',
        'status',
    ];

}
