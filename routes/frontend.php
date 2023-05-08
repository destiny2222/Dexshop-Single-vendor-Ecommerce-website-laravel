<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Front\WishlistController;
use Illuminate\Support\Facades\Route;


// FRONT PAGE
Route::get('/', [PageController::class, 'home'])->name('hone-page');
Route::get('/shop', [PageController::class, 'shop'])->name('shop-page');
// PRODUCT DETAILS
Route::get('/products/{slug}', [pagecontroller::class, 'ItemDetails'])->name('product-details');
Route::get('/products-details/{slug}', [PageController::class, 'ProductDetails'])->name('product-single');
// WISHLIST
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::post('/wishlist/add/', [WishlistController::class, 'addProduct'])->name('wishlist.add');
Route::post('/wishlist/remove/', [WishlistController::class, 'removeProduct'])->name('wishlist.remove');
// CART
Route::get('/cart', [CartController::class, 'carthome'])->name('cart-home');
Route::post('/cart/{product}', [CartController::class, 'store'])->name('cart.store');
Route::post('cart/{id}/increment', [CartController::class, 'increment']);
Route::post('cart/{id}/decrement', [CartController::class, 'decrement']);
Route::delete('/cart/{product}/delete/', [CartController::class, 'destroy'])->name('cart.delete');

// checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout-index');
// Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.submit');
// Route::get('/orders/{order}', [CheckoutController::class, 'show'])->name('orders.show');
Route::post('/payment/callback', [CheckoutController::class, 'handleGatewayCallback']);

//Coupon
// Route::post('/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('apply-coupon');

