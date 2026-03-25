<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard.index');
    
    // Gestión de Usuarios
    Route::resource('usuarios', UsuariosController::class);
    
    // Gestión de Mascotas
    Route::resource('mascotas', \App\Http\Controllers\MascotasController::class);
});

//Ruta para mostrar el formulario de registro
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');

//Ruta para mostrar el formulario de login
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');

//ruta para manejar el registro de usuarios
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

//ruta para mostar el formulario de inicio de sesion 
Route::get('/acceso', [AuthController::class, 'loginForm'])->name('acceso');

//ruta para verificar el inicio de sesion
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');

//ruta para cerrar sesion
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {
Route::get('/admin-dashboard', [AuthController::class, 'adminDashboard'])
->name('admin.dashboard');   
});