<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PoloController;
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

// System routes
Route::redirect('/', '/auth/login');

Route::group(['prefix' => 'auth', 'middleware' => ['guest']], function(){
    Route::get('login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('login', [AuthController::class, 'loginHandler'])->name('auth.login-handler');
    Route::get('register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('register', [AuthController::class, 'registerHandler'])->name('auth.register-handler');
});


Route::group(['middleware' => ['auth']], function(){
    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
    
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::group(['prefix' => 'users'], function(){
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::get('/{user}/classrooms', [UserController::class, 'classrooms'])->name('users.classes');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.delete');
    });

    Route::group(['prefix' => 'classes'], function(){
        Route::get('/', [ClassController::class, 'index'])->name('classes.index');
        Route::post('/', [ClassController::class, 'store'])->name('classes.store');
        Route::get('/create', [ClassController::class, 'create'])->name('classes.create');
        Route::get('/{id}', [ClassController::class, 'show'])->name('classes.show');
        Route::get('/{id}/edit', [ClassController::class, 'edit'])->name('classes.edit');
        Route::get('/{classroom}/aulas', [ClassController::class, 'aulas'])->name('classes.aulas');
        Route::put('/{classroom}/aulas', [ClassController::class, 'storeScore'])->name('classes.aulas.update');
        Route::put('/{classroom}', [ClassController::class, 'update'])->name('classes.update');
        Route::delete('/{id}', [ClassController::class, 'destroy'])->name('classes.delete');
    });

    Route::group(['prefix' => 'payments'], function(){
        Route::get('/', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/csv', [PaymentController::class, 'exportCsv'])->name('payments.csv');
        Route::get('/create', [PaymentController::class, 'create'])->name('payments.create');
        Route::get('/{id}/edit', [PaymentController::class, 'edit'])->name('payments.edit');
        Route::get('/{id}', [PaymentController::class, 'show'])->name('payments.show');
        Route::post('/', [PaymentController::class, 'store'])->name('payments.store');
        Route::put('/{id}', [PaymentController::class, 'update'])->name('payments.update');
        Route::delete('/{id}', [PaymentController::class, 'destroy'])->name('payments.delete');
    });

    Route::resource('polo', PoloController::class);
});
