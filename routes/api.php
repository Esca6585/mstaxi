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

Route::post('/register', [App\Http\Controllers\User\Auth\AuthController::class, 'register']);

Route::post('/login', [App\Http\Controllers\User\Auth\AuthController::class, 'login']);

Route::post('/logout', [App\Http\Controllers\User\Auth\AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/me', [App\Http\Controllers\User\Auth\AuthController::class, 'me'])->middleware('auth:sanctum');

Route::get('/tarifs', [App\Http\Controllers\User\Travel\TravelController::class, 'tarifs'])->middleware('auth:sanctum');

Route::get('/get-statistic', [App\Http\Controllers\User\Travel\TravelController::class, 'getStatistic'])->middleware('auth:sanctum');

Route::get('/day-or-night', [App\Http\Controllers\User\Travel\TravelController::class, 'dayOrNight'])->middleware('auth:sanctum');

Route::post('/measure-two-distance', [App\Http\Controllers\User\Travel\TravelController::class, 'measureTwoDistance'])->middleware('auth:sanctum');

Route::post('/travel-start', [App\Http\Controllers\User\Travel\TravelController::class, 'travelStart'])->middleware('auth:sanctum');

Route::post('/travel-finish', [App\Http\Controllers\User\Travel\TravelController::class, 'travelFinish'])->middleware('auth:sanctum');

Route::post('/route-save', [App\Http\Controllers\User\Travel\TravelController::class, 'routeSave'])->middleware('auth:sanctum');

// Admin Login API

Route::post('/admin/register', [App\Http\Controllers\Admin\Auth\AuthController::class, 'register']);

Route::post('/admin/login', [App\Http\Controllers\Admin\Auth\AuthController::class, 'login']);

Route::post('/admin/logout', [App\Http\Controllers\Admin\Auth\AuthController::class, 'logout'])->middleware('auth:sanctum');