<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'productID',
        'product_name',
        'item_price',
        'item_cost',
        'shipping_charge',
        'shipping_cost',
        'total_sold',
        'returns'
        
    ];
}
