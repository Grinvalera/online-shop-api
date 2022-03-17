<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware' => 'api'], function($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);

    Route::get('/get-user-by-id/{userId}', [UserController::class, 'getUserById']);
    Route::get('/get-all-users', [UserController::class, 'getAllUsers']);

    Route::post('/create-profile', [ProfileController::class, 'store']);
    Route::post('/update-profile/{id}', [ProfileController::class, 'update']);

    Route::get('/get-all-products', [ProductController::class, 'getAllProducts']);
    Route::get('/get-id-products/{id}', [ProductController::class, 'getProductById']);
    Route::post('/add-new-product', [ProductController::class, 'store']);
    Route::post('/update-product/{id}', [ProductController::class, 'update']);
    Route::get('/delete-product/{id}', [ProductController::class, 'destroy']);

    Route::post('/create-order', [OrderController::class, 'store']);
    Route::get('/get-orders-by-user/{userId}', [OrderController::class, 'getUserOrder']);
    Route::get('/get-order-by-id/{orderId}', [OrderController::class, 'getOrderById']);
});
