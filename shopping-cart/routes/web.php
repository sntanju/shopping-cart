<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartItemController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{productId}', [CartItemController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartItemController::class, 'viewCart'])->name('cart.view');
    Route::post('/cart/update/{cartItemId}', [CartItemController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/cart/remove/{cartItemId}', [CartItemController::class, 'removeItem'])->name('cart.remove');
});
// Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
// Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');

// Route::middleware(['auth'])->group(function () {
//     Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add'); 
//     Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view'); 
// });
// Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
