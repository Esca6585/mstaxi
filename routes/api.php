<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [App\Http\Controllers\User\Auth\AuthController::class, 'register']);

Route::post('/login', [App\Http\Controllers\User\Auth\AuthController::class, 'login']);

Route::post('/me', [App\Http\Controllers\User\Auth\AuthController::class, 'me'])->middleware('auth:sanctum');

Route::post('/measure-two-distance', [App\Http\Controllers\User\Travel\TravelController::class, 'measureTwoDistance'])->middleware('auth:sanctum');

Route::post('/travel-start', [App\Http\Controllers\User\Travel\TravelController::class, 'travelStart'])->middleware('auth:sanctum');

Route::post('/route-save', [App\Http\Controllers\User\Travel\TravelController::class, 'routeSave'])->middleware('auth:sanctum');