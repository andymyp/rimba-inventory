<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\SalesController;
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

// ITEMS
Route::get('/items', [ItemController::class, 'index']);
Route::post('/items', [ItemController::class, 'store']);
Route::get('/items/{id}', [ItemController::class, 'show']);
Route::put('/items/{id}', [ItemController::class, 'update']);
Route::put('/items/image/{id}', [ItemController::class, 'image']);
Route::delete('/items/{id}', [ItemController::class, 'destroy']);

// CUSTOMERS
Route::get('/customers', [CustomerController::class, 'index']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::get('/customers/{id}', [CustomerController::class, 'show']);
Route::put('/customers/{id}', [CustomerController::class, 'update']);
Route::put('/customers/ktp/{id}', [CustomerController::class, 'ktp']);
Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);

// SALES
Route::get('/sales', [SalesController::class, 'index']);
Route::post('/sales', [SalesController::class, 'store']);
Route::get('/sales/{id}', [SalesController::class, 'show']);
Route::put('/sales/{id}', [SalesController::class, 'update']);
Route::delete('/sales/{id}', [SalesController::class, 'destroy']);