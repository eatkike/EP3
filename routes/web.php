<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('Auth.login');
});


Route::get('/register', [AuthController::class, 'registerForm'])->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('mascotas', \App\Http\Controllers\MascotasController::class);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard.index');

    Route::resource('usuarios', UsuariosController::class);
    
    Route::get('/admin-dashboard', [AuthController::class, 'adminDashboard'])
        ->name('admin.dashboard');   
});