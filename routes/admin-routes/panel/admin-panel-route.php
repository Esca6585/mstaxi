<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/

Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-z]{2}'],
], function () {
    
    Route::prefix('admin')->group(function(){
        Route::get('/dashboard', [App\Http\Controllers\AdminControllers\Dashboard\DashboardController::class, 'index'])->name('admin.dashboard');
        
        Route::resources([
            '/admin' => App\Http\Controllers\AdminControllers\Admin\AdminController::class,
            '/tarif' => App\Http\Controllers\AdminControllers\Tarif\TarifController::class,
            '/user' => App\Http\Controllers\AdminControllers\User\UserController::class,
            '/travel' => App\Http\Controllers\AdminControllers\Travel\TravelController::class,
        ]);
    });
});