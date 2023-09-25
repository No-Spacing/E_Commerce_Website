<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Cart;
use App\Models\Tag;
use App\Models\Rating;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{

    public function homepage(){
        try{

            $products = Product::selectRaw('SUM(ratings.rating)/COUNT(ratings.customerID) AS avg_rating, products.*')
                        ->leftJoin('ratings', 'ratings.productID', '=', 'products.id')
                        ->groupBy('products.id')
                        ->get();

            $totalPrice = Cart::where('customerID', session('Customer'))->sum('total');

            if(session()->has('Customer')){
                $cart = DB::table('carts')
                ->where('carts.customerID', session('Customer'))
                ->join('products', 'products.id', '=', 'carts.productID')
                ->get();
                
                $customerDetails = ['customerDetails' => Customer::where('id', '=', session('Customer'))->first()];
                
                return view('homepage', $customerDetails)
                    ->with(['products' => $products])
                    ->with(['cart' => $cart])
                    ->with(['totalPrice' => $totalPrice]);
            }

            return view('homepage')
                ->with(['products' => $products]);

        }catch(\Illuminate\Database\QueryException $ex){
            echo "Please start your mysql first.";
        }

    }

    public function viewProduct($productID){
        $details = Product::where('id', $productID)->first();
        $totalPrice = Cart::where('customerID', session('Customer'))->sum('total');
        $reviews = Rating::select('ratings.*')
                        ->where('productID', $productID)
                        ->join('customers','customers.id' , '=' , 'ratings.customerID')->get();
        $rating = Rating::where('productID',$productID)->selectRaw('SUM(rating)/COUNT(customerID) AS avg_rating')->first();

        if(session()->has('Customer')){
            $products = Product::all();
            
            $cart = Cart::where('customerID', session('Customer'))->join('products', 'products.id', '=' ,'carts.productID')->get();
            $customerDetails = ['customerDetails' => Customer::where('id', '=', session('Customer'))->first()];
            return view('view-product', $customerDetails)
                ->with(['details' => $details])
                ->with(['cart' => $cart])
                ->with(['products' => $products])
                ->with(['totalPrice' => $totalPrice])
                ->with(['reviews' => $reviews])
                ->with(['rating' => $rating]);
        }

        return view('view-product')
                ->with(['details' => $details])
                ->with(['reviews' => $reviews])
                ->with(['rating' => $rating]);
    }

    public function searchItem(Request $request){
        $products = Product::where('product', 'LIKE', '%' . $request->search . '%' )->get();
        $totalPrice = Cart::where('customerID', session('Customer'))->sum('total');

        if(session()->has('Customer')){
            $cart = Cart::where('customerID', session('Customer'))->get();
            $customerDetails = ['customerDetails' => Customer::where('id', '=', session('Customer'))->first()];
            return view('search-products', $customerDetails)
                ->with(['items' => $products])
                ->with(['cart' => $cart])
                ->with(['totalPrice' => $totalPrice])
                ->with(['title' => $request->search]);
        }

        return view('search-products')->with(['items' => $products])->with(['title' => $request->search]);

    }

    public function tags($tag){

        $products = DB::table('tags')->where('tagName',$tag)
        ->join('products', 'products.id', '=', 'tags.productID')
        ->get();
        $totalPrice = Cart::where('customerID', session('Customer'))->sum('total');
        if(session()->has('Customer')){
            $cart = Cart::where('customerID', session('Customer'))->get();
            $customerDetails = ['customerDetails' => Customer::where('id', '=', session('Customer'))->first()];
            return view('search-products', $customerDetails)
                ->with(['items' => $products])
                ->with(['cart' => $cart])
                ->with(['totalPrice' => $totalPrice])
                ->with(['title' => $tag]);
        }

        return view('search-products')->with(['items' => $products])->with(['title' => $tag]);

    }
    
}
