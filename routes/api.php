<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

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
// routes/api.php


// Authenticated Routes

Route::group(['prefix' => 'v1'], function () {
    Route::post('users/login', [UserController::class, 'login']);
    Route::apiResource('users', UserController::class)->only('store');

    Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('users/logout', [UserController::class, 'logout']);

    Route::post('/orders', [OrderController::class, 'create']);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::put('/orders/edit/{id}', [OrderController::class, 'update']);
    Route::delete('/orders/delete/{id}', [OrderController::class, 'destroy']);
    Route::post('/orders/search', [OrderController::class, 'search']);
});
});
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
