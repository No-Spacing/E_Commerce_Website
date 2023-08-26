<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Sale;

class AdminController extends Controller
{
    public function sales(){
        $totalsale = Sale::all();

        return view('adminsales')->with(['totalsale' => $totalsale]);
    }
}
