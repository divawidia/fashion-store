<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\HomeUnauthController;
use App\Http\Controllers\CouriersController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\DiscountsController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ProductImagesController;
use App\Http\Controllers\ProductReviewsController;
use App\Http\Controllers\ResponseController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//verifikasi email user
Auth::routes(['verify' => true]);

Route::get('/', [HomeUnauthController::class, 'index']);

Route::get('/verify', function () {
    return view('auth.verify');
});

// Route Login
Route::get('/adminlogin', [AuthController::class, 'adminlogin'])->name('adminlogin');
Route::post('/postlogin', [AuthController::class, 'postlogin']);
Route::post('/postadmin', [AuthController::class, 'postloginAdmin'])->name('admin.login');
Route::get('/logout', [AuthController::class, 'logout']);

// Route Customer
Route::middleware('auth:web')->prefix('users')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('index');
    Route::get('/home/product/{product}', [HomeController::class, 'show']);
    Route::get('/shop', [UserController::class, 'shop']);
    Route::get('/blog', [UserController::class, 'blog']);
    Route::get('/contact', [UserController::class, 'contact']);
    Route::get('/cart', [UserController::class, 'cart']);
    Route::get('/addcart/{id}',[CartsController::class, 'addcart']);
    Route::get('/buynow/{id}',[TransactionsController::class, 'buynow']);
    Route::get('/detailcart',[CartsController::class, 'detailcart']);
    Route::post('/checkout', [TransactionsController::class, 'checkout']);
    Route::get('/kota/{id}', [TransactionsController::class, 'getkota']);
    Route::get('/ongkir', [TransactionsController::class, 'getOngkir']);
    Route::get('/kota/service', [TransactionsController::class, 'getService']);
    Route::post('/transaction/checkout', [TransactionsController::class, 'insertcheckout']);
    Route::get('/viewpayment/{id}', [TransactionsController::class, 'invoice']);
    Route::get('/invoice/{id}', [TransactionsController::class, 'getInvoice']);
    Route::get('/timeout', [TransactionsController::class, 'timeout']);
    Route::post('/review', [TransactionsController::class, 'reviewpage']);
    Route::post('/editreview', [TransactionsController::class, 'revieweditpage']);
    Route::patch('/transactions/cancel/{id}', [TransactionsController::class, 'cancel_transaction']);
    Route::patch('/transactions/success/{id}', [TransactionsController::class, 'confirmation']);
    Route::patch('/upload/{id}', [TransactionsController::class, 'uploadPOP']);
    Route::patch('/review/store', [TransactionsController::class, 'review']);
    Route::patch('/review/edit', [TransactionsController::class, 'reviewedit']);
    Route::get('/image/proof_of_payment/{id}', [TransactionsController::class, 'image']);

    // Notification
    Route::get('/showAllNotif', [UserController::class, 'showAllNotif']);
    Route::get('/markreaduser', [UserController::class, 'markReadUser']);
    Route::post('/userSpesificNotif', [UserController::class, 'userSpesificNotif']);
});

// Route Admin
Route::middleware('auth:admin')->prefix('admin')->group(function () {
    //Route::group(['namespace' => 'admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/cekReport', [AdminController::class, 'cekReport']);
    // Product Page
    Route::resource('/product', ProductsController::class);
    Route::get('/product/{product}', [ProductsController::class, 'show']);
    Route::get('/product/{product}/delete', [ProductsController::class, 'softDelete']);
    Route::get('/product/{product}/add-image', [ProductsController::class, 'upload']);
    Route::post('/product/{product}/add-image', [ProductsController::class, 'upload_image']);
    Route::get('/product/{product}/add-discount', [ProductsController::class, 'discount']);
    Route::post('/product/{product}/add-discount', [ProductsController::class, 'createDiscount']);
    Route::get('/product/{product}/edit-discount', [ProductsController::class, 'editDiscount']);
    Route::put('/product/{product}/edit-discount', [ProductsController::class, 'updateDiscount']);
    Route::delete('/product/{product}/delete-discount', [ProductsController::class, 'deleteDiscount']);
    Route::get('/product/{product}/review/{review}/add-response', [ProductsController::class, 'discount']);
    Route::post('/product/{product}/review/{review}/add-response', [ProductsController::class, 'createDiscount']);

    Route::resource('/product-image', ProductImagesController::class);

    // Courier Page
    Route::resource('/courier', CouriersController::class);

    Route::post('/review/{review}/add-responses', [ProductReviewsController::class, 'response']);
    Route::post('/review/{review}/add-response', [ProductReviewsController::class, 'addResponse']);

    Route::get('/response/{response}/edit', [ResponseController::class, 'edit']);
    Route::put('/response/{response}/edit', [ResponseController::class, 'update']);
    Route::get('/response/{response}/delete', [ResponseController::class, 'destroy']);
    
    // Category Page
    Route::resource('/category', ProductCategoriesController::class);

    // Discount Page
    Route::resource('/discount', DiscountsController::class);

    // Transaction Page
    Route::get('/transaction', [TransactionsController::class, 'index']);
    Route::get('/transaction-add', [TransactionsController::class, 'add']);
    Route::get('/transaksi/detail/{id}', [TransactionsController::class, 'TransactionDetail']);
    Route::patch('/transaksi/update/{id}', [TransactionsController::class, 'TransactionUpdate']);

    // Reports Page
    Route::get('/reports', [ReportsController::class, 'index']);

    // Notification
    Route::get('/showAllNotif', [AdminController::class, 'showAllNotif']);
    Route::get('/markreadadmin', [AdminController::class, 'markReadAdmin']);

    Route::post('/readSpesificNotif', [AdminController::class, 'readSpesificNotif']);
    
    Route::post('/viewpdf', [PdfController::class, 'viewprint']);
    Route::post('/pdf', [PdfController::class, 'print']);
});
//Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
