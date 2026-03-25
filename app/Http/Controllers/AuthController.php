<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //Mostrar formulario de registro
    public function registerForm()
    {
        return view('auth.register');
    }

    //Procesar registro de usuario
    public function register(Request $request)
    {
        //Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);
        
        //Crear el usuario en la tabla usuarios con contraseña encriptada
        //Usamos 'name' del formulario como 'nombre' en la tabla
        $usuario = Usuarios::create([
            'nombre' => $request->name,
            'apellido' => '', // Campo requerido pero no está en el formulario
            'email' => $request->email,
            'password' => $request->password, //El mutador encriptará automáticamente
        ]);

        //Iniciar sesión automáticamente
        auth()->login($usuario);

        return redirect()->route('usuarios.index')->with('success', 'Registro exitoso. Bienvenido, ' . $usuario->nombre . '!');
    }

    //Metodo para mostrar formulario de inicio de sesion
    public function loginForm()
    {
        return view('auth.login');
    }

    // metodo para iniciar sesion
    public function login(Request $request)
    {
        //Validar los valores del formulario
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        //Credenciales para autenticar
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        //Realizar intento de inicio de sesion
        if (Auth::attempt($credentials)) {
            //Regenerar la sesión para seguridad
            $request->session()->regenerate();
            
            //Redireccionar a la pagina de usuarios con mensaje de exito
            return redirect()->route('usuarios.index')
            ->with('success', 'Inicio de sesión exitoso. Bienvenido,
             ' . Auth::user()->nombre . '!');
        }

        //Si falla, retornar con error
        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    //Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login')->with('success', 'Sesión cerrada correctamente.');
    }
}
