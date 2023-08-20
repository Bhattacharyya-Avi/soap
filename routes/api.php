<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CurrencyController;

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

// Route::post('/test',[ProductController::class,'holidaysOfYear']);
// Route::post('/products',[ProductController::class,'getWeather']);
Route::get('/',[ClientController::class,'productList']);
Route::get('/allProducts',[ServerController::class,'allProducts']);

Route::post('/convertCurrency',[CurrencyController::class,'convertCurrency']);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
