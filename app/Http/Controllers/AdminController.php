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
use Illuminate\Support\Facades\Hash;


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
                ->with(['totalOrders' => $totalOrders]);
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
        $sales = Sale::whereYear('created_at', '=', date('Y'))
        ->whereMonth('created_at', '=', date('m'))
        ->get();
        return view('admin.adminSales')
        ->with(['sales' => $sales]);
    }

    public function updateTime(Request $request){
        $monthNum = substr($request->datepicker, 0, -5);
        $month = date("F", mktime(null, null, null, $monthNum));

        $yearNum = substr($request->datepicker, 3, 7);

        $sales = Sale::whereYear('created_at', '=', $yearNum)
              ->whereMonth('created_at', '=', $monthNum)
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

            $product = Product::where('id',$id)->update([
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

    public function adminOrders(){
        $orderStatus = Checkout::join('customers','customers.id' ,'=' ,'checkouts.customerID')->get();

        return view('admin.adminOrders')->with(['orderStatus' => $orderStatus]);
    }

    public function logout(){
        if(session()->has('Admin')){
            session()->pull('Admin');
            return redirect('home');
        }
    }

}
