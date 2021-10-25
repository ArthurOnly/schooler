<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'auth', 'middleware' => ['guest']], function(){
    Route::get('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('login', [AuthController::class, 'loginHandler'])->name('auth.login-handler');
    Route::get('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('register', [AuthController::class, 'registerHandler'])->name('auth.register-handler');
});


Route::group(['middleware' => ['guest']], function(){
    Route::group(['prefix' => 'users'], function(){
        Route::get('/teachers', [UserController::class, 'indexTeachers'])->name('users.index-teachers');
    });
});
