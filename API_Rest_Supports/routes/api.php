<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StockController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::apiResource('slaughterHouse',App\Http\Controllers\SlaughterhouseController::class);
Route::apiResource('skin',App\Http\Controllers\SkinController::class);
Route::post('auth',[AuthController::class, 'login']);
Route::apiResource('sale',App\Http\Controllers\SaleController::class);
Route::get('stock',[StockController::class, 'getStock']);
