<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Cashier\CashierCartController;
use App\Http\Controllers\Cashier\CashierProductController;
use App\Http\Controllers\Cashier\CashierTransactionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified', 'role:1'])->prefix('/admin')->group(function () {
    Route::controller(AdminDashboardController::class)->prefix('/dashboard')->group(function () {
        Route::get('/', 'index')->name('admin.dashboard');
        Route::get('/show/{id}', 'show')->name('admin.dashboard.show');
    });
    Route::controller(AdminProductController::class)->prefix('/product')->group(function () {
        Route::get('/', 'index')->name('admin.product');
        Route::get('/create', 'create')->name('admin.product.create');
        Route::post('/store', 'store')->name('admin.product.store');
        Route::get('/destroy/{id}', 'destroy')->name('admin.product.destroy');
        Route::get('/edit/{id}', 'edit')->name('admin.product.edit');
        Route::post('/update/{id}', 'update')->name('admin.product.update');
        Route::post('/find', 'find')->name('admin.product.find');
    });
    Route::controller(AdminUserController::class)->prefix('/user')->group(function () {
        Route::get('/', 'index')->name('admin.user');
        Route::get('/create', 'create')->name('admin.user.create');
        Route::post('/store', 'store')->name('admin.user.store');
    });
});

Route::middleware(['auth', 'verified', 'role:0'])->prefix('/cashier')->group(function () {
    Route::controller(CashierProductController::class)->prefix('/product')->group(function () {
        Route::get('/', 'index')->name('cashier.product');
        Route::post('/find', 'find')->name('cashier.product.find');
    });
    Route::controller(CashierCartController::class)->prefix('/cart')->group(function () {
        Route::get('/', 'index')->name('cashier.cart');
        Route::get('/store/{id}', 'store')->name('cashier.cart.store');
        Route::post('/update/{id}', 'update')->name('cashier.cart.update');
    });
    Route::controller(CashierTransactionController::class)->prefix('/transaction')->group(function () {
        Route::get('/', 'index')->name('cashier.transaction');
        Route::get('/show/{id}', 'show')->name('cashier.transaction.show');
        Route::post('/checkout', 'checkout')->name('cashier.transaction.checkout');
    });
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';