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

// Route::get('/home', function() {
//     return view('homepage');
// });
Route::get('/home', [ProductController::class, 'homepage'])->name('home');
Route::get('/view-product/{productID}', [ProductController::class, 'viewProduct'])->name('view.product');
Route::post('/searchItem',[ProductController::class, 'searchItem'])->name('search.item');


Route::group(['middleware'=>['customerCheck']], function(){

    Route::get('/register', function() {
        return view('register');
    })->name('register');
    Route::get('/addToCart/{id}', [ProductController::class, 'addToCart'])->name('addToCart');
    Route::get('/deleteProduct/{id}', [ProductController::class, 'deleteProduct']);
    Route::post('/saveProfile', [CustomerController::class, 'saveProfile'])->name('save.profile');
    Route::post('/updateCart', [CustomerController::class, 'updateCart'])->name('update.cart');
    Route::get('/checkout', [CustomerController::class, 'checkout'])->name('checkout');
    Route::get('/place-order', [CustomerController::class, 'placeOrder'])->name('place.order');
    
    Route::get('/send-mail', [CustomerController::class, 'sendMail']);

    Route::get('/logout', [CustomerController::class, 'logout'])->name('logout');
});
Route::post('/submitLogin', [CustomerController::class, 'submitLogin'])->name('submit.login') ;
 


Route::get('/adminsales', [AdminController::class, 'sales'])->name('admin.sales');

Route::post('/submitRegister', [CustomerController::class, 'submitRegister'])->name('submit.register');

// Route::get('/home', [ProductController::class, 'show_product']);
