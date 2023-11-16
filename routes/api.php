<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('catalog/{category?}/{subcategory?}', [CategoryController::class, 'index']);

Route::get('products/{product:slug}', [ProductController::class, 'index']);

Route::group(['prefix' => 'carts'], function () {
    Route::get('/', [CartController::class, 'index']);
    Route::get('add/{id}', [CartController::class, 'add']);
    Route::patch('update', [CartController::class, 'update']);
    Route::delete('delete', [CartController::class, 'delete']);
});

Route::get('order/create', [OrderController::class, 'create']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    
    Route::get('/orders', [OrderController::class, 'index']);
});
