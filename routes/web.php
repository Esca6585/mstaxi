<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/distance', function(){
    return view('distance');
});

Route::redirect('/', config('app.locale'));

Route::get('/login', function(){
    return redirect()->route('admin.login', app()->getlocale());
} )->name('login');

Route::get('tm/email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
Route::get('tm/email/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');
Route::post('tm/email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');

Route::group([
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-z]{2}'],
], function () {
    Route::get('/', function () {
        return view('user-panel.index');
    });
    
    Auth::routes(
        [
            'login' => false,
            'register' => false,
        ]);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
});


require __DIR__ . '/admin-routes/auth/admin-auth-route.php';
require __DIR__ . '/admin-routes/panel/admin-panel-route.php';
