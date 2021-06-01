<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

// Home de la página
Route::get('/', [HomeController::class, 'index'])->name('home');
Auth::routes();

// products
Route::get('/product/create', [ProductsController::class, 'create']);
Route::get('/product/purched', [ProductsController::class, 'showPurched'])->name('purched');
Route::get('/product/buy/{product}', [ProductsController::class, 'buy'])->name('buy');
Route::get('/product/{product}', [ProductsController::class, 'show'])->name('show-product');

Route::post('/product/cart/{product}', [ProductsController::class, 'cart'])->name('cart');
Route::post('/product', [ProductsController::class, 'store']);
Route::post('/product/buy', [ProductsController::class, 'buyProduct']);

// Users
Route::get('/profile/', [UserController::class, 'show'])->name('profile');
Route::get('/profile/edit', [UserController::class, 'edit'])->name('edit-profile');
Route::patch('/profile/update', [UserController::class, 'update'])->name('update-profile');
