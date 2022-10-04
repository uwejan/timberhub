<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SuppliersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/// Product Routes
Route::group([
    'prefix' => 'products'
], function ($router) {
    Route::post('/', [ProductsController::class, 'store']);
    Route::get('/',[ProductsController::class, 'index']);
});


/// Suppliers Routes
Route::group([
    'prefix' => 'suppliers'
], function ($router) {
    Route::get('/',[SuppliersController::class, 'index']);

});
