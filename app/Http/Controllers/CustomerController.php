<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Checkout;
use App\Models\Cart;
use App\Models\Sale;
use App\Models\Rating;
use App\Models\Inventory;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Mail\Markdown;

use Luigel\Paymongo\Facades\Paymongo;

use App\Mail\SendMail;
use App\Mail\SendCode;

use Xendit\Configuration;
use Xendit\PaymentRequest\PaymentRequestApi;
use Xendit\PaymentRequest\PaymentRequestParameters;
use Xendit\Customer\CustomerApi;
use Xendit\Customer\CustomerRequest;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;

class CustomerController extends Controller
{
    public function submitRegister(Request $request){

        $request->validate([
            'lname' => 'required',
            'fname' => 'required',
            'address' => 'required|min:10',
            'number' => 'required|numeric|min:10',
            'regEmail' => 'required|email|unique:customers,email',
            'password' => 'required|min:6',
        ],[
            'lname.required' => 'The last name field is required',
            'fname.required' => 'The first name field is required',
            'regEmail.required' => 'The email is a required field',
            'regEmail.email' => 'The email field must be a valid email address.',
            'regEmail.unique' => 'The email has already been taken.',
        ]);
        
        $create = Customer::create([
            'name' => $request->lname. " " . $request->fname . " " . $request->mname,
            'fname' => $request->fname,
            'mname' => $request->mname,
            'lname' => $request->lname,
            'address' => $request->address,
            'number' => $request->number,
            'email' => $request->regEmail,
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
            return redirect('home');
            
        }else{
            return back()->with('fail', 'Invalid credentials');
        }

    }

    public function sendCode(Request $request){
        $request->validate([
            'email' => 'required|email|exists:customers'
        ]);

        $content = rand(100000, 999999);

        $request->session()->put('Code', $content);
        $request->session()->put('Email', $request->email);

        $customerName = Customer::where('email', $request->email)
                        ->first();

        Mail::to($request->email)->send(new SendCode($content, $customerName));

        return back()->with('sendCodeSuccess', 'Your code has been sent to your given email.');

    }

    public function submitCode(Request $request){

        $request->validate([
            'code' => 'required',
        ]);

        if(session('Code') == $request->code){
            $request->session()->forget('Code');
            return view('changePassword');
        }else{
            return back()->with('errorCode', 'Code is invalid! Please check your email.');
        }
    }

    public function submitChangePassword(Request $request){
        $request->validate([
            'password' => 'required|min:6',
            'retypePassword' => 'required|same:password|min:6'
        ]);

        Customer::where('email',session('Email'))
                    ->update(['password' => Hash::make($request->password)]);

        $request->session()->forget('Email');

        return redirect('/home')->with('changedPassword', 'Password has been updated!');
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

    public function cancelOrder($id){
        Checkout::where('id', $id)->update(['status' => 'cancelled']);
        return back();
    }
    
    public function refundOrder($id){
        $payment = Checkout::where('id', $id)->first();
        $refund = Paymongo::refund()->create([
            'amount' => $payment->total,
            'notes' => $payment->product,
            'payment_id' => $payment->paymentID,
            'reason' => \Luigel\Paymongo\Models\Refund::REASON_REQUESTED_BY_CUSTOMER,
        ]);
        Checkout::where('id', $id)->update(['status' => 'refunded']);
        return back();
    }

    public function saveProfile(Request $request){
        $request->validate([
            'address' => 'required|min:10',
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

    public function deleteProduct($id)
    {

        $quantity = Cart::where('customerID', session('Customer'))
                ->where('productID', $id)
                ->first();

        $productQuantity = Product::where('id', $id)->first();

        Product::where('id', $id)
                ->update([
                'remaining' => $productQuantity->remaining + $quantity->quantity, 
                'max_quantity' => $productQuantity->remaining + $quantity->quantity
                ]);

        Cart::where('customerID', session('Customer'))
            ->where('productID', $id)
            ->delete();
        return back()->with('successCart','Product has been deleted to cart.');
       
    }

    public function checkout(Request $request){
        
        $customerCheck = Customer::where('id', session('Customer'))->first();
        if($customerCheck->address == NULL && $customerCheck->number == NULL){
            return back()->with('checkProfile', 'Please type your address and mobile number in order to proceed to checkout.');
        }else{
            $products = Cart::where('customerID', session('Customer'))->get();
            if(!$products->isEmpty()){

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
        //$products = Cart::where('customerID', session('Customer'))->get();
        $products = Cart::where('customerID', session('Customer'))->get();
          
        if(!$products->isEmpty()){      
            
            if($request->paymentMethod == "Payment Gateway"){
                
                $total = $products->sum('total') + 20;
    
                if(session()->has('payment_link')){
                    return redirect()->route('payment.gateway');
                }else{
                    Configuration::setXenditKey("xnd_production_wMfJNEr9NxerJxHBgXZRFOCaEIcDBxDQb2RmtwYUIWxNvtNnDyRWJD0SZB3mI0f"); 
                    // $link = Paymongo::link()->create([
                    //     'amount' => $total,
                    //     'description' => 'Payment in Products',
                    //     'remarks' => 'laravel-paymongo'
                    // ]);

                    $apiInstance = new InvoiceApi();
                    $create_invoice_request = new CreateInvoiceRequest([
                        'external_id' => 'Brigada Healthline Care',
                        'description' => 'Payment for Products',
                        'amount' => 1,
                        'invoice_duration' => 172800,
                        'currency' => 'PHP',
                        'reminder_time' => 1
                    ]); // \Xendit\Invoice\CreateInvoiceRequest
                    
                    $link = "";

                    $link = $apiInstance->createInvoice($create_invoice_request);
                    
                    session()->put('payment_link',$link);

                    return redirect()->route('payment.gateway');
                }
            }else{
                foreach($products as $product){
                    $totalQuantity = Sale::where('productID', $product->productID)->first();
                    Sale::create([
                        'productID' => $product->productID,
                        'product_name' => $product->product,
                        'item_price' => $product->price,
                        'item_cost' => rand(55,60),
                        'shipping_charge' => 20,
                        'shipping_cost' => 15,
                        'total_sold' => $product->quantity,
                    ]);
                    $maxQuantity = Product::where('id', $product->productID)->first();
                    Product::where('id', $product->productID)->update(['max_quantity' => $maxQuantity->max_quantity - $product->quantity]);
                    Inventory::create([
                        'name' => $product->product,
                        'action' => "was purchased by " . $customer->fname . " " . $customer->lname . " with total of " . $product->quantity . " items"
                    ]);
                }
    
                foreach($products as $product){
                    Checkout::create([
                        'customerID' => session('Customer'),
                        'productID' => $product->productID,
                        'product' => $product->product,
                        'quantity' => $product->quantity,
                        'payment' => $request->paymentMethod,
                        'total' => $product->total,
                        'status' => "pending",
                    ]);
                } 
    
                session()->put('products', $products); 
                $content = session()->get('products');
                $total = session()->get('products')->sum('total');
    
                $payment = $request->paymentMethod;
    
                $message = "We received your #BHC12345 on ". date('Y-m-d H:i:s') . " and you'll be paying for this via $payment. 
                We're getting your order ready and will let you know once it's on the way. 
                We wish you enjoy shopping with us and hope to see you again real soon!";
    
                Mail::to($customer['email'])->send(new SendMail($content, $customer, $total, $message));
                Cart::where('customerID', session('Customer'))->delete();
    
                return view('placeOrder')->with(['customer' => $customer])->with(['total' => $total])->with(['paymentOption' => $payment]);
            }
           
        }else{
            return redirect()->route('home')->with('failOrder', 'Please add your product to cart first before proceeding');
        }
    }

    public function paymentGateway(){
        $customer = Customer::where('id', session('Customer'))->first();
        if(session()->has('payment_link')){
            $linkbyReference = session()->get('payment_link');

            Configuration::setXenditKey("xnd_production_wMfJNEr9NxerJxHBgXZRFOCaEIcDBxDQb2RmtwYUIWxNvtNnDyRWJD0SZB3mI0f");
            $apiInstance = new InvoiceApi();
        
            $status = $apiInstance->getInvoiceById($linkbyReference['id']);
         
            if($status['status'] == "PAID"){
                $products = Cart::where('customerID', session('Customer'))->get();
                if($products != null){
                    
                    foreach($products as $product){
                        $totalQuantity = Sale::where('productID', $product->productID)->first();
    
                        Sale::create([
                            'productID' => $product->productID,
                            'product_name' => $product->product,
                            'item_price' => $product->price,
                            'item_cost' => rand(55,60),
                            'shipping_charge' => 20,
                            'shipping_cost' => 15,
                            'total_sold' => $product->quantity,
                        ]);

                        Inventory::create([
                            'name' => $product->product,
                            'action' => "was purchased by " . $customer->fname . " " . $customer->lname . " with total of " . $product->quantity . " item(s)"
                        ]);

                        $maxQuantity = Product::where('id', $product->productID)->first();
                        Product::where('id', $product->productID)->update(['max_quantity' => $maxQuantity->max_quantity - $product->quantity]);
                        
                    }
    
                    foreach($products as $product){
                        Checkout::create([
                            'customerID' => session('Customer'),
                            'paymentID' =>  $status['id'],
                            'productID' => $product->productID,
                            'product' => $product->product,
                            'quantity' => $product->quantity,
                            'payment' => $status['payment_method'],
                            'total' => $status['amount'],
                            'status' => "paid",
                        ]);
                    } 
                }
                $customer = Customer::where('id', session('Customer'))->first();
                $content =  Cart::where('customerID', session('Customer'))->get();
                $total = $status['amount'];
                $payment = $status['payment_method'];
                $message = "We received your #BHC12345 on ". date('Y-m-d H:i:s') . " and you'll be paying for this via $payment. 
                We're getting your order ready and will let you know once it's on the way. 
                We wish you enjoy shopping with us and hope to see you again real soon!";
    
                Mail::to($customer['email'])->send(new SendMail($content, $customer, $total, $message));

                session()->put('paid','Payment Successfully Recorded!'); 
                Cart::where('customerID', session('Customer'))->delete();
                return view('payment-gateway');
            }else{
                return view('payment-gateway');
            }
        }else{
            echo "No Transaction Occured!";
        }
        
    }

    public function paymentSessionPull(){
        if(session()->has('payment_link')){
            session()->pull('payment_link');
            session()->pull('paid');
        }    
        return redirect('home');
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

    public function doctorSchedule(){
        $customerDetails = ['customerDetails' => Customer::where('id', '=', session('Customer'))->first()];
        $totalPrice = Cart::where('customerID', session('Customer'))->sum('total');
        $cart = Cart::where('customerID', session('Customer'))->join('products', 'products.id', '=' ,'carts.productID')->get();
        $checkouts = Checkout::where('customerID', session('Customer'))->get();
        return view('doctorSchedule', $customerDetails)
            ->with(['cart' => $cart])
            ->with(['totalPrice' => $totalPrice])
            ->with(['checkouts' => $checkouts]);
    }


    function logout(){
        if(session()->has('Customer')){
            session()->pull('Customer');
            return redirect('home');
        }
    }
}
