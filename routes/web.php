<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ProductController::class, 'catalog'])->name('catalog');

Auth::routes();
Route::get('/users', [UserController::class, 'listUsers'])->name('listUsers')->middleware('isAdmin');
Route::get('/users/{user}/delete', [UserController::class, 'delete'])->name('deleteUser')->middleware('isAdmin');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('editUserForm')->middleware('isAdmin');
Route::put('/users/{user}/edit', [UserController::class, 'update'])->name('editUser')->middleware('isAdmin');

Route::get('/products/create', [ProductController::class, 'create'])->name('createProduct')->middleware('isSpecialUser');
Route::post('/products/store', [ProductController::class, 'store'])->name('storeProduct')->middleware('isSpecialUser');
Route::get('/products', [ProductController::class, 'index'])->name('listProducts')->middleware('isSpecialUser');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('showProduct');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('editProduct')->middleware('isSpecialUser');
Route::put('/products/{product}/edit', [ProductController::class, 'update'])->name('updateProduct')->middleware('isSpecialUser');
Route::get('/products/{product}/delete', [ProductController::class, 'destroy'])->name('destroyProduct')->middleware('isSpecialUser');

Route::get('/cart', [CartController::class, 'show'])->name('showCart')->middleware('isLoggedIn');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('addToCart')->middleware('isLoggedIn');
Route::get('/cart/remove/{product}', [CartController::class, 'remove'])->name('removeFromCart')->middleware('isLoggedIn');

Route::get('/orders', [OrderController::class, 'index'])->name('listOrders')->middleware('isSpecialUser');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orderDetails')->middleware('isSpecialUser');
Route::post('/orders/store', [OrderController::class, 'store'])->name('storeOrder')->middleware('isLoggedIn');

Route::get('/thank-you', function () {
   return view('thank-you');
})->name('thankYouPage');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
