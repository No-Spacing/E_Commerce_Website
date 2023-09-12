<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Checkout;
use App\Models\Cart;
use App\Models\Sale;
use App\Models\Rating;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function submitRegister(Request $request){

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6',
        ]);
        
        $create = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if($create){
            return back()->with('success','Account has been successfully created.');
        } else {
            return back()->with('unsuccess', 'Something went wrong please try again.');
        }
    
    }

    public function submitLogin(Request $request){
        $request->validate([
            'emailLogin' => 'required|email',
            'passwordLogin' => 'required',
        ],
        [
            'emailLogin.required' => 'The email field is required.',
            'emailLogin.email' => 'The email field must be a valid email address.',
            'passwordLogin' => 'The password field is required.',
        ]);

        $customerLogin = Customer::where('email', '=', $request->emailLogin)->first();

        if($customerLogin && Hash::check($request->passwordLogin,$customerLogin->password)){
            $request->session()->put('Customer',$customerLogin->id);
            return back();
            
        }else{
            return back()->with('fail', 'Invalid credentials');
        }

    }

    public function orders(){
        $customerDetails = ['customerDetails' => Customer::where('id', '=', session('Customer'))->first()];
        $totalPrice = Cart::where('customerID', session('Customer'))->sum('total');
        $cart = Cart::where('customerID', session('Customer'))->join('products', 'products.id', '=' ,'carts.productID')->get();
        $checkouts = Checkout::where('customerID', session('Customer'))->get();
        return view('orders', $customerDetails)
            ->with(['cart' => $cart])
            ->with(['totalPrice' => $totalPrice])
            ->with(['checkouts' => $checkouts]);
    }

    public function saveProfile(Request $request){
        $request->validate([
            'address' => 'required',
            'number' => 'required|min:10',
        ]);

        Customer::where('id', session('Customer'))->update([
            'birthdate' => $request->birthdate,
            'address' => $request->address,
            'number' => $request->number,
        ]);

        return back()->with('successProfile', 'Profile has been successfully saved.');
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
            Product::where('id', $id)->update(['remaining' => $product->remaining-1]);
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
            Product::where('id', $id)->update(['remaining' => $product->remaining-1]);
        }

        return back()->with('successCart', 'Product has been added to cart.');
    } 

    public function updateCart(Request $request){

        $id = [];
        $quantity = [];
        $message = [];

        foreach($request->id as $value){
            array_push($id , $value);
        }

        foreach($request->quantity as $value){
            array_push($quantity , $value);
        }
        
        foreach($id as $key => $data){
            $max = Product::where('id', $id[$key])->first();
            
            $total = Cart::where('customerID', session('Customer'))
                        ->where('productID', $id[$key])
                        ->first();


            if($quantity[$key] >= $max->max_quantity){

                Cart::where('customerID', session('Customer'))
                    ->where('productID', $id[$key])
                    ->update([
                        'quantity' => $max->max_quantity, 
                        'total' => $total['price'] * ($total->quantity + $max->remaining)
                        ]);

                Product::where('id', $id[$key])
                    ->update([ 'remaining' => 0 ]);
            }else{
               
                Product::where('id', $id[$key])
                ->update(['remaining' => $max->remaining + $total->quantity - $quantity[$key]]);

                Cart::where('customerID', session('Customer'))
                    ->where('productID', $id[$key])
                    ->update([
                        'quantity' => $quantity[$key], 
                        'total' => $total['price'] * $quantity[$key]
                        ]);
            }
            
        }

        return back()->with('successCart', "Your cart has been updated");

    }

    public function deleteProduct($id)
    {

        $quantity = Cart::where('customerID', session('Customer'))
                ->where('productID', $id)
                ->first();

        Product::where('id', $id)
                ->update(['remaining' => $quantity->quantity]);

        Cart::where('customerID', session('Customer'))
            ->where('productID', $id)
            ->delete();
        return back()->with('successCart','Product has been deleted to cart.');
       
    }

    public function checkout(){
        
        $customerCheck = Customer::where('id', session('Customer'))->first();
        if($customerCheck->address == NULL && $customerCheck->number == NULL){
            return back()->with('checkProfile', 'Please type your address and mobile number in order to proceed to checkout.');
        }else{
            $products = Cart::where('customerID', session('Customer'))->get();
            if(!$products->isEmpty()){
                
                $products = Cart::where('customerID', session('Customer'))->get();
                $customer = Customer::where('id', session('Customer'))->first();
                $total = Cart::where('customerID', session('Customer'))->sum('total');
                return view('payment')->with(['products' => $products])->with(['customer' => $customer])->with(['total' => $total]);
            }else{
                return redirect()->route('home')->with('failOrder', 'Please add your product to cart first before proceeding');
            }
            
        }
    }

    public function placeOrder(Request $request){
        $customer = Customer::where('id', session('Customer'))->first();
        $products = Cart::where('customerID', session('Customer'))->get();
          
        if(!$products->isEmpty()){      
            session()->put('products', $products); 
            $content = session()->get('products');
            $total = session()->get('products')->sum('total');
             
            foreach($products as $product){
                $totalQuantity = Sale::where('productID', $product->productID)->first();
                if($totalQuantity == NULL){
                    Sale::create([
                        'productID' => $product->productID,
                        'product_name' => $product->product,
                        'item_price' => $product->price,
                        'item_cost' => rand(55,60),
                        'shipping_charge' => 20,
                        'shipping_cost' => 15,
                        'total_sold' => $product->quantity,
                    ]);
                }else{  
                    Sale::where('productID',$product->productID)->update(['total_sold' => $totalQuantity['total_sold'] + $product->quantity]);
                }
            }

            foreach($products as $product){
                Checkout::create([
                    'customerID' => session('Customer'),
                    'productID' => $product->productID,
                    'product' => $product->product,
                    'quantity' => $product->quantity,
                    'total' => $product->total,
                ]);
            } 

            Mail::to($customer['email'])->send(new SendMail($content, $customer, $total));
            Cart::where('customerID', session('Customer'))->delete();

            return view('placeOrder')->with(['customer' => $customer])->with(['total' => $total])->with(['paymentOption' => $request->paymentMethod]);     
                      
        }else{
            return redirect()->route('home')->with('failOrder', 'Please add your product to cart first before proceeding');
        }
    }

    public function submitReview(Request $request){

        $request->validate([
            'comment' => 'required',
            'rating' => 'required',
        ]);

        Rating::create([
            'customerID' => session('Customer'),
            'productID' => $request->productID,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back();  
        
    }


    function logout(){
        if(session()->has('Customer')){
            session()->pull('Customer');
            return redirect('home');
        }
    }
}
