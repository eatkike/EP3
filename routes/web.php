<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

//Rutas públicas
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//Rutas privadas
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

Route::middleware('auth')->group(function () {
    Route::resource('solicitudes', SolicitudController::class);
});