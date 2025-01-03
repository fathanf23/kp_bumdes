<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\JenisProdukController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DetailTransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('frontend/beranda');
});

// Route Halaman Utama
Route::get('/catering', [FrontController::class, 'catering'])->name('catering');
Route::get('/playground', [FrontController::class, 'playground'])->name('playground');
Route::get('/all-product', function () {
    return view('all-product');
});

Route::get('/catering', [FrontController::class, 'catering'])->name('catering');

// Route Beranda
Route::get('/frontend/beranda/', [FrontController::class, 'beranda'])->name('beranda');

// Routing Login Register
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('/login_proses', [LoginController::class, 'login_proses'])->name('login_proses');
Route::get('register', [LoginController::class, 'register'])->name('register');
Route::get('register/store', [LoginController::class, 'registerStore']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


// Routing Cart
Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/checkout/process', [CartController::class, 'process'])->name('checkout.process');


// Admin Dashboard
Route::get('/admin/dashboard/', [DashboardController::class, 'index'])->name('admin');

// Admin Produk
Route::prefix('admin/produk')->group(function () {
    Route::get('/index', [ProdukController::class, 'index']);
    Route::get('/create', [ProdukController::class, 'create']);
    Route::post('/store', [ProdukController::class, 'store']);
    Route::get('/destroy/{id}', [ProdukController::class, 'destroy']);
    Route::get('/edit/{id}', [ProdukController::class, 'edit']);
    Route::post('/update/{id}', [ProdukController::class, 'update']);
});
Route::prefix('admin/jenis_produk')->group(function () {
    Route::get('/index', [JenisProdukController::class, 'index']);
    Route::get('/create', [JenisProdukController::class, 'create']);
    Route::post('/store', [JenisProdukController::class, 'store']);
    Route::get('/destroy/{id}', [JenisProdukController::class, 'destroy']);
    Route::get('/edit/{id}', [JenisProdukController::class, 'edit']);
    Route::post('/update/{id}', [JenisProdukController::class, 'update']);
   
});
// Admin Transaksi
Route::prefix('admin/transaksi')->group(function () {
    Route::get('/index', [TransaksiController::class, 'index']);
    Route::get('/create', [TransaksiController::class, 'create']);
    Route::post('/store', [TransaksiController::class, 'store']);
    Route::get('/edit/{id}', [TransaksiController::class, 'edit']);
    Route::post('/update/{id}', [TransaksiController::class, 'update']);
    Route::get('/destroy/{id}', [TransaksiController::class, 'destroy']);
});
// Admin Detail Transaksi
Route::prefix('admin/detail_transaksi')->group(function () {
    Route::get('/index', [DetailTransaksiController::class, 'index']);
    Route::get('/create', [DetailTransaksiController::class, 'create']);
    Route::post('/store', [DetailTransaksiController::class, 'store']);
    Route::get('/edit/{id}', [DetailTransaksiController::class, 'edit']);
    Route::post('/update/{id}', [DetailTransaksiController::class, 'update']);
    Route::get('/destroy/{id}', [DetailTransaksiController::class, 'destroy']);

});
// Admin User
Route::prefix('admin/user')->group(function () {
    Route::get('/index', [UserController::class, 'index']);
});
