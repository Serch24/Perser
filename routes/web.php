<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
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
Route::get('/',[HomeController::class,'index'])->name('home'); 

Route::get('/product/create', [ProductsController::class, 'create']);
Route::get('/product/{product}', [ProductsController::class, 'show']);
Route::get('/product/buy/{product}', [ProductsController::class, 'buy'])->name('buy');
Route::get('/product/cart/{product}', [ProductsController::class, 'cart'])->name('cart');
Route::post('/product',[ProductsController::class, 'store']);


Auth::routes();