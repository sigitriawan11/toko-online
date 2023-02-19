<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/carts', [CartController::class, 'index']);
    Route::post('/carts', [CartController::class, 'store']);
    Route::get('/purchase', [PurchaseController::class, 'index']);
    Route::post('/purchase', [PurchaseController::class, 'createPurchase']);
    Route::get('/purchase/{purchase:token}/checkout', [PurchaseController::class, 'checkout']);
    Route::get('/purchase/{purchase:token}', [PurchaseController::class, 'purchase']);
    Route::put('/purchase/{purchase:token}', [PurchaseController::class, 'checkoutStatus']);
    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::get('/account/carts', [CartController::class, 'index'])->name('carts');
    Route::get('/account/cart/{cart:product_code}', [CartController::class, 'show'])->name('pay-cart');
});
Route::middleware(['auth', 'is_admin'])->group(function (){
    Route::get('/account/products', [AccountController::class, 'products'])->name('products');
    Route::get('/account/products/create', [AccountController::class, 'createProduct'])->name('create-product');
    Route::get('/account/categories', [AccountController::class, 'categories'])->name('categories');
    Route::get('/account/categories/create', [AccountController::class, 'createCategory'])->name('create-category');

    Route::resource('/products', ProductController::class);
    Route::resource('/categories', CategoryController::class);
});

require __DIR__.'/auth.php';
