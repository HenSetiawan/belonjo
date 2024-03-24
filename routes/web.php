<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\OverviewController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProductSuppliesController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\TransactionController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\PaymentController;

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


// public route
Route::get('/', [HomeController::class, 'index']);


Route::middleware('auth')->group(function () {
    // admin route middleware
    Route::middleware('role:admin')->group(function(){
        //manajemen produk
        Route::get('/dashboard', [OverviewController::class, 'index']);
        Route::get('/produk', [ProductController::class, 'index']);
        Route::get('/input-produk', [ProductController::class, 'create']);
        Route::delete('/hapus-produk/{id}', [ProductController::class, 'delete']);
        Route::post('/input-produk', [ProductController::class, 'store']);
        Route::get('/ubah-produk/{id}', [ProductController::class, 'edit']);
        Route::post('/ubah-produk/{id}', [ProductController::class, 'update']);
        Route::get('/products',[ProductController::class,'getAllProducts']);


        // manajemen kategori
        Route::get('/kategori', [CategoryController::class, 'index']);
        Route::get('/input-kategori', [CategoryController::class, 'create']);
        Route::post('/input-kategori', [CategoryController::class, 'store']);
        Route::delete('/hapus-kategori/{id}', [CategoryController::class, 'delete']);
        Route::get('/ubah-kategori/{id}', [CategoryController::class, 'edit']);
        Route::post('/ubah-kategori/{id}', [CategoryController::class, 'update']);

        // manajemen data admin
        Route::get('/admin', [UserController::class, 'admin']);
        Route::get('/input-admin', [UserController::class, 'createAdmin']);
        Route::post('/input-admin', [UserController::class, 'storeAdmin']);
        Route::delete('/hapus-admin/{id}', [UserController::class, 'delete']);
        Route::get('/ubah-admin/{id}', [UserController::class, 'editAdmin']);
        Route::post('/ubah-admin/{id}', [UserController::class, 'updateAdmin']);

        // manajemen user
        Route::get('/users',[UserController::class,'users']);
        Route::delete('/hapus-user/{id}', [UserController::class, 'delete']);

        // manajemen produk masuk (stock)
        Route::get('/produk-masuk', [ProductSuppliesController::class, 'indexIncome']);
        Route::get('/input-barang-masuk', [ProductSuppliesController::class, 'createIncome']);
        Route::get('/ubah-barang-masuk/{id}', [ProductSuppliesController::class, 'editIncome']);
        Route::post('/ubah-barang-masuk/{id}', [ProductSuppliesController::class, 'updateIncome']);
        Route::post('/input-barang-masuk', [ProductSuppliesController::class, 'storeIncome']);
        Route::delete('/hapus-barang-masuk/{id}', [ProductSuppliesController::class,'deleteProductSupply']);

        // manajemen produk keluar (stock)
        Route::get('/produk-keluar', [ProductSuppliesController::class, 'indexOutcome']);
        Route::get('/input-barang-keluar', [ProductSuppliesController::class, 'createOutcome']);
        Route::post('/input-barang-keluar', [ProductSuppliesController::class, 'storeOutcome']);
        Route::delete('/hapus-barang-keluar/{id}', [ProductSuppliesController::class,'deleteProductSupply']);
        Route::get('/ubah-barang-keluar/{id}', [ProductSuppliesController::class, 'editOutcome']);
        Route::post('/ubah-barang-keluar/{id}', [ProductSuppliesController::class, 'updateOutcome']);

        // manajemen traksaksi
        Route::get('/transaksi-masuk', [TransactionController::class, 'index']);
    });
    Route::get('/logout',[AuthController::class, 'logout']);

    // user route
    Route::middleware('role:user')->group(function(){
        Route::get('/order/{id}',[OrderController::class,'index']);
        Route::post('/order',[OrderController::class,'order']);
        Route::delete('/order/{id}',[OrderController::class,'delete']);
        Route::get('/transaksi',[OrderController::class,'orderList']);

        Route::post('/payment',[PaymentController::class,'paymentHandler']);

    });
});


// route tamu (tidak sedang login)
Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get('/register',[UserController::class,'register']);
    Route::post('/register',[UserController::class,'registerUser']);
});
