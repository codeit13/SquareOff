<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/images', function () {
    return view('images');
});

Route::get('admin',[App\Http\Controllers\HomeController::class, 'admin'])->name('admin');

Route::get('admin/{id?}',[App\Http\Controllers\HomeController::class, 'orderEdit'])->name('admin');

Route::post('getData',[App\Http\Controllers\HomeController::class, 'getOrders'])->name('getOrders');
Route::post('saveOrder',[App\Http\Controllers\HomeController::class, 'saveOrder'])->name('saveOrder');
Route::post('updateOrder',[App\Http\Controllers\HomeController::class, 'updateOrder'])->name('updateOrder');

Route::get('upload-images', [ App\Http\Controllers\HomeController::class, 'showImages' ]);
Route::post('upload-images', [ App\Http\Controllers\HomeController::class, 'storeImage' ])->name('images.store');
