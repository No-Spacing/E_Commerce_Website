<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Cart;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{

    public function homepage(){
        $products = Product::all();
        $totalPrice = Cart::where('customerID', session('Customer'))->sum('total');

        if(session()->has('Customer')){
            $cart = Cart::where('customerID', session('Customer'))->get();
            $customerDetails = ['customerDetails' => Customer::where('id', '=', session('Customer'))->first()];
            return view('homepage', $customerDetails)
                ->with(['products' => $products])
                ->with(['cart' => $cart])
                ->with(['totalPrice' => $totalPrice]);
        }


        // if(session('cart')){
        //     foreach(session('cart') as $data){
        //         $totalPrice = $totalPrice + $data['total'];
        //     }
        // }

        return view('homepage')->with(['products' => $products]);

    }

    public function viewProduct($productID){
        $products = Product::where('id', $productID)->first();
        $totalPrice = Cart::where('customerID', session('Customer'))->sum('total');

        if(session()->has('Customer')){
            $cart = Cart::where('customerID', session('Customer'))->get();
            $customerDetails = ['customerDetails' => Customer::where('id', '=', session('Customer'))->first()];
            return view('view-product', $customerDetails)
                ->with(['products' => $products])
                ->with(['cart' => $cart])
                ->with(['totalPrice' => $totalPrice]);
        }

        return view('view-product')->with(['products' => $products]);
        
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

    public function addToCart($id){
        $totalPrice = 0; 
        $totalQuantity = 0;

        $product = Product::where('id', $id)->first();

        $cart = Cart::where('customerID', session('Customer'))
                    ->where('productID', $id)
                    ->first();
       
        if($cart){
            $totalQuantity = $cart->quantity+1;
            $totalPrice = $cart->total + $product->price;
            Cart::where('customerID', session('Customer'))
                ->where('productID', $id)
                ->update(['total' => $totalPrice, 'quantity' => $totalQuantity]);
        }else{
            Cart::create([
                'customerID' => session('Customer'),
                'productID' => $id,
                'product' => $product->product,
                'quantity' => 1,
                'price' => $product->price,
                'total' => $product->price,
                'image' => $product->image,
    
            ]);
        }

        // $cart = session()->get('cart', []);
        // if(isset($cart[$id])) {
        //     $cart[$id]['quantity']++;
        //     $cart[$id]['total'] = $cart[$id]['price'] + $product->price;
         
        // } else {
        //     $cart[$id] = [
        //         "product" => $product->product,
        //         "quantity" => 1,
        //         "price" => $product->price,
        //         "total" => $product->price,
        //         "image" => $product->image
        //     ];
        // }
        // session()->put('cart', $cart);
        return back()->with('successCart', 'Product has been added to cart.');
    } 

    public function deleteProduct($id)
    {
        Cart::where('customerID', session('Customer'))
            ->where('productID', $id)
            ->delete();
        return back()->with('successCart','Product has been deleted to cart.');
       
    }
    
}
