<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Models\Product;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BotManController;
use Illuminate\Mail\Markdown;


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



Route::post('adminLoginRequest', [AdminController::class, 'adminLoginRequest'])->name('admin.login.request');

Route::group(['middleware' => ['adminCheck']], function () {

    Route::get('/adminLogin', function() {
        return view('admin.adminLogin');
    }); 

    Route::get('/adminHome', [AdminController::class, 'adminHome'])->name('admin.home');

    Route::get('/adminAdBanner', [AdminController::class, 'bannerList'])->name('admin.ad.banner');

    Route::post('/adminUploadBanner', [AdminController::class, 'uploadBanner'])->name('upload.banner');

    Route::get('/adminOrders', [AdminController::class, 'adminOrders'])->name('admin.orders');

    Route::get('acceptOrder/{id}', [AdminController::class, 'acceptOrder'])->name('accept.order');

    Route::get('declineOrder/{customerID}/productID/{id}', [AdminController::class, 'declineOrder'])->name('decline.order');

    Route::get('shipOrder/{id}', [AdminController::class, 'shipOrder'])->name('ship.order');

    Route::post('/setBanner', [AdminController::class, 'setBanner'])->name('set.banner');

    Route::get('/deleteBanner/{id}', [AdminController::class, 'deleteBanner'])->name('delete.banner');

    Route::get('/adminEditProduct/{id}' , [AdminController::class, 'adminEditProduct'])->name('admin.edit.product');

    Route::post('submitEditProduct/{id}', [AdminController::class, 'submitEditProduct'])->name('submit.edit.product');

    Route::get('/adminAddProducts', function(){
        return view('admin.adminAddProducts');
    })->name('admin.add.products');

    Route::post('/addProduct',[AdminController:: class, 'addProduct'])->name('add.product');

Route::get('/adminDeleteProduct/{id}',[AdminController:: class, 'adminDeleteProduct'])->name('admin.delete.product');

    Route::get('/adminSales', [AdminController::class, 'adminSales'])->name('admin.sales');
    //Route::get('/adminSalesGraph', [AdminController::class,'adminSalesGraph'])->name('admin.sales.graph');

    Route::get('/updateTime', [AdminController::class, 'updateTime'])->name('update.time');
    Route::get('/dailyTime', [AdminController::class, 'dailyTime'])->name('daily.time');
    Route::get('/monthlyTime', [AdminController::class, 'monthlyTime'])->name('monthly.time');
    Route::get('/yearlyTime', [AdminController::class, 'yearlyTime'])->name('yearly.time');


    Route::get('/adminCustomer', [AdminController::class, 'customers'])->name('admin.customer');

    Route::get('/adminProductList', [AdminController::class, 'productList'])->name('admin.product.list');

    Route::get('/inventoryLog', [AdminController::class, 'inventoryLog'])->name('inventory.log');

    Route::get('/generatePDF', [AdminController::class, 'generatePDF'])->name('generate.pdf');

    Route::get('/adminLogout', [AdminController::class, 'logout'])->name('admin.logout');
    
});

Route::get('/home', [ProductController::class, 'homepage'])->name('home');
Route::get('/view-product/{productID}', [ProductController::class, 'viewProduct'])->name('view.product');
Route::get('/searchItem',[ProductController::class, 'searchItem'])->name('search.item');
Route::get('/tags/{tag}', [ProductController::class, 'tags'])->name('tags');
Route::get('/sort/{sort}', [ProductController::class, 'sort'])->name('sort');
Route::get('/termsAgreement', function () {
    return view('termsPolicy');
})->name('terms.agreement');

Route::group(['middleware'=>['customerCheck']], function(){

    Route::get('/register', function() {
        return view('register');
    })->name('register');
    Route::get('/addToCart/{id}', [CustomerController::class, 'addToCart'])->name('add.to.cart');
    Route::get('/deleteProduct/{id}', [CustomerController::class, 'deleteProduct'])->name('delete.product');
    Route::get('/orders', [CustomerController::class, 'orders'])->name('orders');

    Route::get('/cancelOrder/{id}', [CustomerController::class, 'cancelOrder'])->name('cancel.order');
    Route::get('/refundOrder/{id}', [CustomerController::class, 'refundOrder'])->name('refund.order');

    Route::post('/saveProfile', [CustomerController::class, 'saveProfile'])->name('save.profile');
    Route::post('/updateCart', [CustomerController::class, 'updateCart'])->name('update.cart');
    Route::post('/checkout', [CustomerController::class, 'checkout'])->name('checkout');
    
    Route::post('/submitReview', [CustomerController::class, 'submitReview'])->name('submit.review');
    
    Route::post('/place-order', [CustomerController::class, 'placeOrder'])->name('place.order');
    Route::get('/payment-gateway', [CustomerController::class, 'paymentGateway'])->name('payment.gateway');
    Route::get('/payment-session-pull', [CustomerController::class, 'paymentSessionPull'])->name('payment.session.pull');



    Route::get('/send-mail', [CustomerController::class, 'sendMail']);

    Route::get('/logout', [CustomerController::class, 'logout'])->name('logout');

});

Route::post('/submitLogin', [CustomerController::class, 'submitLogin'])->name('submit.login');
Route::post('/submitRegister', [CustomerController::class, 'submitRegister'])->name('submit.register');

Route::post('/sendCode', [CustomerController::class, 'sendCode'])->name('send.code');
Route::post('/submitCode', [CustomerController::class, 'submitCode'])->name('submit.code');

Route::get('/changePassword', function() {
    return view('changePassword');
} )->name('change.password');

Route::post('/submitChangePassword', [CustomerController::class, 'submitChangePassword'])->name('submit.change.password');

Route::get('/testBot', function(){
    return view('bot');
});
Route::match(['get', 'post'], '/botman', 'App\Http\Controllers\BotManController@handle');




// Route::get('/home', [ProductController::class, 'show_product']);
