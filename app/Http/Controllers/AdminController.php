<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Tag;

class AdminController extends Controller
{
    public function adminSales(){
        $totalsale = Sale::whereYear('created_at', '=', 12)
        ->whereMonth('created_at', '=', 01)
        ->get();
        return view('admin.adminSales')
        ->with(['month' => 'January'])
        ->with(['totalsale' => $totalsale]);
    }

    public function updateTime(Request $request){
        $monthNum = substr($request->datepicker, 0, -5);
        $month = date("F", mktime(null, null, null, $monthNum));

        $yearNum = substr($request->datepicker, 3, 7);

        $totalsale = Sale::whereYear('created_at', '=', $yearNum)
              ->whereMonth('created_at', '=', $monthNum)
              ->get();

        return view('admin.adminSales')->with(['totalsale' => $totalsale])->with(['month' => $month]);
    }

    public function customers(){
        $customers =  Customer::all();
        return view('admin.adminCustomer')->with(['customers' => $customers]);
    }

    public function addProduct(Request $request){
        $request->validate([
            'product' => 'required',
            'price' => 'required|integer',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,jfif',
            'tag' => 'required'
        ],
        [
            'image.required' => 'Please upload your product image',
            'tag.required' => 'Please select your tag for your product'
        ]);

        $fileName = $request->image->getClientOriginalName();
        $path = "products/";
        $fullFile = $path . $fileName;
       
        $request->file('image')->move(public_path('products'), $fileName);

        $product = Product::create([
            'product' => $request->product,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $fullFile
        ]);


        $productID = Product::orderBy('id', 'DESC')->first();

        
        $tagging = Tag::create([
            'productID' => $productID['id'],
            'tagName' => $request->tag,
        ]);

        return back()->with('success', 'Your product has been added');
        
    }

    public function productList(){
        $products = Product::all();
        return view('admin.AdminProductList')->with(['products' => $products]);
    }

}
