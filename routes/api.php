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

Route::post('/coordinate-save', [App\Http\Controllers\User\Travel\TravelController::class, 'coordinateSave'])->middleware('auth:sanctum');

// Admin Login API

Route::post('/admin/login', [App\Http\Controllers\Admin\Auth\AuthController::class, 'login']);
Route::post('/admin/logout', [App\Http\Controllers\Admin\Auth\AuthController::class, 'logout'])->middleware('auth:sanctum');

// Admin App API
Route::get('/travels', [App\Http\Controllers\Admin\Api\AdminController::class, 'travels'])->middleware('auth:sanctum');
Route::get('/users', [App\Http\Controllers\Admin\Api\AdminController::class, 'users'])->middleware('auth:sanctum');
Route::get('/users/statistic', [App\Http\Controllers\Admin\Api\AdminController::class, 'userStatistic'])->middleware('auth:sanctum');
Route::get('/user/statistic', [App\Http\Controllers\Admin\Api\AdminController::class, 'userStatistic'])->middleware('auth:sanctum');

Route::get('/user/{id}',[App\Http\Controllers\Admin\Api\AdminController::class, 'user'])->middleware('auth:sanctum');
Route::get('/user/delete/{id}', [App\Http\Controllers\Admin\Api\AdminController::class, 'userDelete'])->middleware('auth:sanctum');
Route::post('/user/create', [App\Http\Controllers\Admin\Api\AdminController::class, 'userCreate'])->middleware('auth:sanctum');
Route::get('/user-block-unblock/{id}', [App\Http\Controllers\Admin\Api\AdminController::class, 'userBlockUnblock'])->middleware('auth:sanctum');
Route::post('/user-update', [App\Http\Controllers\Admin\Api\AdminController::class, 'userUpdate'])->middleware('auth:sanctum');

Route::get('/tarif/{id}',[App\Http\Controllers\Admin\Api\AdminController::class, 'tarif'])->middleware('auth:sanctum');
Route::get('/tarif/delete/{id}', [App\Http\Controllers\Admin\Api\AdminController::class, 'tarifDelete'])->middleware('auth:sanctum');
Route::post('/tarif/create', [App\Http\Controllers\Admin\Api\AdminController::class, 'tarifCreate'])->middleware('auth:sanctum');
Route::post('/tarif-update', [App\Http\Controllers\Admin\Api\AdminController::class, 'tarifUpdate'])->middleware('auth:sanctum');

Route::post('/send-notification', [App\Http\Controllers\Admin\Api\AdminController::class, 'sendNotification'])->middleware('auth:sanctum');