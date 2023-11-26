<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Checkout;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Admin;
use App\Models\Banner;
use App\Models\Inventory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\CancelOrder;
use Carbon\Carbon;
use PDF;

class AdminController extends Controller
{

    public function adminLoginRequest(Request $request){

        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

      
        $adminLogin = Admin::where('username', '=', $request->username)->first();

        if($adminLogin && Hash::check($request->password,$adminLogin->password)){
            $request->session()->put('Admin',$adminLogin->id);
            return redirect('adminHome');
            
        }else{
            return back()->with('fail', 'Invalid credentials');
        }
       
    }

    public function adminHome(){
        $products = Sale::all();
        $totalOrders = Checkout::select('id')->count();
        $pendingOrder = Checkout::where('status', 'pending')->count();
        // $sales = Sale::whereYear('created_at', '=', date('Y'))
        //             ->whereMonth('created_at', '=', date('m'))
        //             ->orderBy('total_sold', 'DESC')
        //             ->take(5)
        //             ->get();
        $sales = DB::select('SELECT * FROM (SELECT *,sum(total_sold) as total_sold1 FROM sales GROUP BY product_name ORDER BY total_sold DESC limit 5)Var1 Order by total_sold ASC');
        $allSales = Sale::select(DB::raw('* ,sum(total_sold) as total_sold'))
        ->groupBy('product_name')
        ->get();


        $totalSale = 0;
        $totalSold = 0;
        foreach($products as $product){
           $totalSale += $product->total_sold * $product->item_price;
           $totalSold += $product->total_sold;
        }

        $monthlySale = number_format((float)$totalSale/12, 2, '.', '');

        return view('admin.adminHome')
                ->with(['monthlySale' => $monthlySale])
                ->with(['totalSold' => $totalSold])
                ->with(['totalOrders' => $totalOrders])
                ->with(['pendingOrder' => $pendingOrder])
                ->with(['sales' => $sales])
                ->with(['allSales' => $allSales]);
    }

    public function uploadBanner(Request $request){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,jfif|dimensions:min_width=1920,min_height=1080|dimensions:max_width=1920,max_height=1080'
        ]);

        $fileName = $request->image->getClientOriginalName();
        $path = "banners/";
        $fullFile = $path . $fileName;
       
        $request->file('image')->move(public_path('banners'), $fileName);

        $banner = Banner::create([
            'name' => $fileName,
            'image' => $fullFile,
            'setValue' => 0,
        ]);

        return back();
    }

    public function setBanner(Request $request){
        
        foreach($request->checked as $key=>$checked){
            if($checked == 1){
                Banner::where('id', $key)->update(['setValue' => 1]);
            }else{
                Banner::where('id', $key)->update(['setValue' => 0]);
            }
        }
        return back()->with('success', 'Banner has been applied!');
     
        
    }

    public function deleteBanner($id){
        Banner::where('id', $id)->delete();
        return back();
    }

    public function bannerList(){
        $banners = Banner::all();
        return view('admin.adminAdBanner')->with(['banners' => $banners]);
    }

    public function adminSales(){
        $sales = Sale::select(DB::raw('* ,sum(total_sold) as total_sold'))
        ->groupBy('product_name')
        ->get();

        return view('admin.adminSales')
        ->with(['sales' => $sales]);
    }

    public function updateTime(Request $request){
        $monthNum = substr($request->datepicker, 0, -5);
        $month = date("F", mktime(null, null, null, $monthNum));

        $yearNum = substr($request->datepicker, 3, 7);

        $sales = Sale::select(DB::raw('* ,sum(total_sold) as total_sold'))
                ->whereYear('updated_at', '=', $yearNum)
                ->whereMonth('updated_at', '=', $monthNum)
                ->groupBy('product_name')
                ->get();

        return view('admin.adminSales')->with(['sales' => $sales]);
    }

    public function dailyTime(){

        $sales = Sale::select(DB::raw('* ,sum(total_sold) as total_sold'))
        ->where('created_at','>=', date('Y-m-d'))
        ->groupBy('product_name')
        ->get();
      
        return view('admin.adminSales')->with(['sales' => $sales]);
    }

    public function monthlyTime(){
        $sales = Sale::select(DB::raw('*, sum(total_sold) as total_sold'))
        ->whereMonth('created_at', '=', date('m'))
        ->groupBy('product_name')
        ->get();

        return view('admin.adminSales')
        ->with(['sales' => $sales]);
    }

    public function yearlyTime(){
        $sales = Sale::select(DB::raw('*, sum(total_sold) as total_sold'))
        ->whereYear('created_at', '=', date('Y'))
        ->groupBy('product_name')
        ->get();

        return view('admin.adminSales')->with(['sales' => $sales]);
    }

    public function customers(){
        $customers =  Customer::all();
        return view('admin.adminCustomer')->with(['customers' => $customers]);
    }

    public function addProduct(Request $request){
        $request->validate([
            'product' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,jfif',
            'remaining' => 'required|integer',
            'tag' => 'required'
        ],
        [
            'image.required' => 'Please upload your product image',
            'remaining.required' => 'The quantity field is required',
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
            'remaining' => $request->remaining,
            'max_quantity' => $request->remaining,
            'image' => $fullFile
        ]);

        $inventory = Inventory::create([
            'name' => $request->product,
            'action' => 'New product added.',
        ]);


        $productID = Product::orderBy('id', 'DESC')->first();

        
        $tagging = Tag::create([
            'productID' => $productID['id'],
            'tagName' => $request->tag,
        ]);

        return back()->with('success', 'Your product has been added');
        
    }

    public function adminEditProduct($id){
        $products = Product::where('products.id', $id)->join('tags', 'products.id', '=', 'tags.id')->first();
        return view('admin.adminEditProduct')->with(['product' => $products]);
    }

    public function submitEditProduct($id, Request $request){
        $request->validate([
            'product' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'remaining' => 'required|integer',
            'tag' => 'required'
        ],
        [
            'remaining.required' => 'The quantity field is required',
            'tag.required' => 'Please select your tag for your product'
        ]);
        
        

        if($request->hasFile('image'))
        {
            $fileName = $request->image->getClientOriginalName();
            $path = "products/";
            $fullFile = $path . $fileName;
        
            $request->file('image')->move(public_path('products'), $fileName);

            $update = "Update(s) - ";
            $check = Product::where('id', $id)->first();
            if($check->product != $request->product){
                $update .= "Product Name: " . $check->product . " to " . $request->product . ",";
            }
            if($check->price != $request->price){
                $update .= "Price: " . $check->price . " to " . $request->price . ",";
            }
            if($check->remaining != $request->remaining){
                $update .= "Quantity(s): "  . $check->remaining . " to " . $request->remaining . ",";
            }
            if($check->description != $request->description){
                $update .= "Description: " . $request->description . ",";
            }
            if($check->image != $fullFile){
                $update .= "Image: " . $fileName . ",";
            }
            
            
            if($check->product != $request->product || 
            $check->price != $request->price || 
            $check->remaining != $request->remaining || 
            $check->description != $request->description ||
            $check->image != $fullFile)
            {
                Inventory::create([
                    'name' => $check->product,
                    'action' => $update
                ]);
            }

            $product = Product::where('id', $id)->update([
                'product' => $request->product,
                'price' => $request->price,
                'description' => $request->description,
                'remaining' => $request->remaining,
                'max_quantity' => $request->remaining,
                'image' => $fullFile
            ]);
            Tag::where('id',$id)
            ->update(['tagName' => $request->tag]);

            return back()->with('success', 'Product successfully saved');
            
        }else{
            $update = "Update(s) - ";
            $check = Product::where('id', $id)->first();

            if($check->product != $request->product){
                $update .= "Product Name: " . $check->product . " to " . $request->product . ",";
            }
            if($check->price != $request->price){
                $update .= "Price: " . $check->price . " to " . $request->price . ",";
            }
            if($check->remaining != $request->remaining){
                $update .= "Quantity(s): ". $check->remaining . " to " . $request->remaining . ",";
            }
            if($check->description != $request->description){
                $update .= "Description: " . $request->description . ",";
            }
            
            

            if($check->product != $request->product || $check->price != $request->price || $check->remaining != $request->remaining || $check->description != $request->description)
            {
                Inventory::create([
                    'name' => $check->product,
                    'action' => $update
                ]);
            }

            Product::where('id', $id)
            ->update(['product' => $request->product,
                      'price' => $request->price,
                      'description' => $request->description,
                      'remaining' => $request->remaining,
                      'max_quantity' => $request->remaining,]);
            Tag::where('id',$id)
            ->update(['tagName' => $request->tag]);

            return back()->with('success', 'Product successfully saved');
            
        }
    }

    public function productList(){
        $products = Product::all();
        return view('admin.AdminProductList')->with(['products' => $products]);
    }

    public function adminDeleteProduct($id){
        
        $name = Product::where('id', $id)->first();       

        Inventory::create([
            'name' => $name->product,
            'action' => 'Product has been removed',
        ]);   

        Tag::where('id', $id)->delete();
        Product::where('id', $id)->delete();  
   
        return back();
    }

    public function adminOrders(){
        $orderStatus = Checkout::select('checkouts.id as id', 'checkouts.product as product','customers.id as customerID',
                                        'checkouts.quantity as quantity', 'customers.name as name',
                                        'customers.number as number', 'customers.address as address',
                                        'checkouts.status as status','checkouts.created_at as created_at',
                                        'checkouts.payment as payment')
                                ->join('customers','customers.id' ,'=' ,'checkouts.customerID')
                                ->get();

        return view('admin.adminOrders')->with(['orderStatus' => $orderStatus]);
    }

    public function acceptOrder($id){
        Checkout::where('id', $id)->update(['status' => 'accepted']);
        return back();
    }

    public function declineOrder($customerID, $id){
        
        $customer = Customer::where('id', $customerID)->first();
        $content = Checkout::where('id', $id)->first();
        $message = "Your order #BHC12345 on ". $content['created_at'] . " and you'll be paying for this via ".  $content['payment'] . ". 
            We're sorry to inform you that your details or order did not meet our requirements. 
            We wish you enjoy shopping with us and hope to see you again real soon!";

        Mail::to($customer['email'])->send(new CancelOrder($content, $customer, $content['total'], $message));
        Checkout::where('id', $id)->update(['status' => 'declined']);
        return back();
        
    }

    public function shipOrder($id){
        Checkout::where('id', $id)->update(['status' => 'shipped']);
        return back();
    }

    public function inventoryLog(){
        $inventories = Inventory::all();
        return view('admin.adminInventoryLog')->with(['inventories' => $inventories]);
    }


    function generatePDF(){
             
        $sales = Sale::select(DB::raw('* ,sum(total_sold) as total_sold'))
        ->groupBy('product_name')
        ->get();
       
        $pdf = PDF::loadView('salesPdf', ['sales' => $sales]);

        return $pdf->stream('sales.pdf');
    }

    public function logout(){
        if(session()->has('Admin')){
            session()->pull('Admin');
            return redirect('home');
        }
    }

}
