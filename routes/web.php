<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
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
    
    Route::get('/dashboard-coordinator', [DashboardController::class, 'cordinator'])->name('dashboard.coordinator');
    Route::get('/dashboard-teacher', [DashboardController::class, 'teacher'])->name('dashboard.teacher');
    Route::get('/dashboard-student', [DashboardController::class, 'student'])->name('dashboard.student');

    Route::group(['prefix' => 'users'], function(){
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.delete');
    });

    Route::group(['prefix' => 'classes'], function(){
        Route::get('/', [ClassController::class, 'index'])->name('classes.index');
        Route::post('/', [ClassController::class, 'store'])->name('classes.store');
        Route::get('/create', [ClassController::class, 'create'])->name('classes.create');
        Route::get('/{id}', [ClassController::class, 'show'])->name('classes.show');
        Route::get('/{id}/edit', [ClassController::class, 'edit'])->name('classes.edit');
        Route::put('/{id}', [ClassController::class, 'update'])->name('classes.update');
        Route::delete('/{id}', [ClassController::class, 'destroy'])->name('classes.delete');
    });
});
