<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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
Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class)->except(['edit', 'update', 'destroy']);
Route::post('orders/{order}/complete', [OrderController::class, 'complete'])->name('orders.complete');

Route::get('/', function () {
    return redirect()->route('products.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
