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
Route::get('/',[HomeController::class,'index']); 

Route::get('/product/create', function () {
    return view('products.upload');
});
Route::get('/product/{product}', [ProductsController::class, 'show']);
Route::post('/product',[ProductsController::class, 'store']);


Auth::routes();