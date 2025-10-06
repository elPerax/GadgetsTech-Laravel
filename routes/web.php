<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\MyOrdersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Shop Page
Route::get('/', [ProductController::class, 'shop'])->name('shop');
Route::get('/search', [ProductController::class, 'search'])->name('products.search'); // 🔍 AJAX Search

// Cart routes (for customers)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Checkout routes
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/thankyou', function () {
    return view('checkout.thankyou');
})->name('checkout.thankyou'); 

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Order History
    Route::get('/my-orders', [MyOrdersController::class, 'index'])->name('my.orders');

    // Product Management (admin only)
    Route::middleware(['admin'])->group(function () {
        Route::resource('products', ProductController::class);
        Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
    });
});

require __DIR__.'/auth.php';
