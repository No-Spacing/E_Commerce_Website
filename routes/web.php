<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Models\Product;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/adminHome', function(){
    return view('admin.adminHome');
})->name('admin.home');

Route::get('/adminAddProducts', function(){
    return view('admin.adminAddProducts');
})->name('admin.add.products');

Route::post('/addProduct',[AdminController:: class, 'addProduct'])->name('add.product');

Route::get('/adminSales', [AdminController::class, 'adminSales'])->name('admin.sales');
Route::get('/updateTime', [AdminController::class, 'updateTime'])->name('update.time');
Route::get('/adminCustomer', [AdminController::class, 'customers'])->name('admin.customer');

Route::get('/adminProductList', [AdminController::class, 'productList'])->name('admin.product.list');

Route::get('/home', [ProductController::class, 'homepage'])->name('home');
Route::get('/view-product/{productID}', [ProductController::class, 'viewProduct'])->name('view.product');
Route::get('/searchItem',[ProductController::class, 'searchItem'])->name('search.item');
Route::get('/tags/{tag}', [ProductController::class, 'tags'])->name('tags');

Route::group(['middleware'=>['customerCheck']], function(){

    Route::get('/register', function() {
        return view('register');
    })->name('register');
    Route::get('/addToCart/{id}', [ProductController::class, 'addToCart'])->name('add.to.cart');
    Route::get('/deleteProduct/{id}', [ProductController::class, 'deleteProduct'])->name('delete.product');
    Route::post('/saveProfile', [CustomerController::class, 'saveProfile'])->name('save.profile');
    Route::post('/updateCart', [CustomerController::class, 'updateCart'])->name('update.cart');
    Route::get('/checkout', [CustomerController::class, 'checkout'])->name('checkout');
    Route::get('/place-order', [CustomerController::class, 'placeOrder'])->name('place.order');
    
    Route::get('/send-mail', [CustomerController::class, 'sendMail']);

    Route::get('/logout', [CustomerController::class, 'logout'])->name('logout');
    
});
Route::post('/submitLogin', [CustomerController::class, 'submitLogin'])->name('submit.login') ;
 



Route::post('/submitRegister', [CustomerController::class, 'submitRegister'])->name('submit.register');

// Route::get('/home', [ProductController::class, 'show_product']);
