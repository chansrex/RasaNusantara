<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SelfOrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

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

// Route untuk halaman utama
Route::get('/', function() {
    return redirect()->route('self-order.index');
});

// Auth Routes untuk Admin
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes untuk Self-Ordering System
Route::prefix('order')->name('self-order.')->group(function () {
    // Halaman registrasi customer
    Route::get('/', [SelfOrderController::class, 'index'])->name('index');
    Route::post('/register', [SelfOrderController::class, 'register'])->name('register');
    
    // Halaman menu dan pemesanan (harus login sebagai customer)
    Route::middleware(['auth'])->group(function() {
        Route::get('/menu', [SelfOrderController::class, 'menu'])->name('menu');
        Route::get('/menu/{id}', [SelfOrderController::class, 'showMenu'])->name('menu-detail');
        Route::get('/cart', [SelfOrderController::class, 'cart'])->name('cart');
        Route::post('/cart/add', [SelfOrderController::class, 'addToCart'])->name('add-to-cart');
        Route::delete('/cart/remove/{index}', [SelfOrderController::class, 'removeFromCart'])->name('remove-from-cart');
        Route::post('/checkout', [SelfOrderController::class, 'checkout'])->name('checkout');
        Route::get('/status/{orderId}', [SelfOrderController::class, 'orderStatus'])->name('order-status');
        Route::get('/history', [SelfOrderController::class, 'orderHistory'])->name('order-history');
    });
});

// Routes untuk Admin Dashboard - diproteksi dengan middleware admin
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Menu Management
    Route::prefix('menu')->name('menu.')->group(function () {
        Route::get('/', [AdminController::class, 'menuList'])->name('index');
        Route::get('/create', [AdminController::class, 'createMenu'])->name('create');
        Route::post('/store', [AdminController::class, 'storeMenu'])->name('store');
        Route::get('/{id}/edit', [AdminController::class, 'editMenu'])->name('edit');
        Route::put('/{id}', [AdminController::class, 'updateMenu'])->name('update');
        Route::delete('/{id}', [AdminController::class, 'destroyMenu'])->name('destroy');
    });
    
    // Order Management
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [AdminController::class, 'orderList'])->name('index');
        Route::get('/{id}', [AdminController::class, 'orderDetail'])->name('detail');
        Route::put('/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('update-status');
    });
    
    // Reports
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
});
