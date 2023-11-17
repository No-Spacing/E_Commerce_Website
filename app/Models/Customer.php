<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fname',
        'mname',
        'lname',
        'email',
        'password',
        'birthdate',
        'address',
        'number'
    ];

    protected $hidden = [
        'password'
    ];
}
