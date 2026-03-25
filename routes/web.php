<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    //Ruta para obtener los metodos de UsuariosController
    Route::resource('usuarios',UsuariosController::class);
});

// Ruta para ver la lista de usuarios
Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');

// Ruta para ver el formulario de creación
Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');

// Ruta para recibir los datos del formulario (POST)
Route::post('/usuarios', [UsuariosController::class, 'store'])->name('usuarios.store');

// Ruta para mostrar el formulario de edición (necesitamos el ID)
Route::get('/usuarios/{id}/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit');

// Ruta para procesar la actualización
Route::put('/usuarios/{id}', [UsuariosController::class, 'update'])->name('usuarios.update');

// Ruta para eliminar
Route::delete('/usuarios/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');


Route::get('/usuarios/{id}', [UsuariosController::class, 'show'])->name('usuarios.show');

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