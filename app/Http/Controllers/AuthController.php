<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\AlertaLoginCorreo;


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


        $usuariosRegistrados = Usuarios::count();
        if ($usuariosRegistrados == 0) {
            $isAdmin = true; // El primer usuario registrado será admin
        } else {            $isAdmin = false; // Los siguientes usuarios no serán admin
        }

        $usuario = Usuarios::create([
            'nombre' => $request->name,
            'apellido' => '', // Campo requerido pero no está en el formulario
            'email' => $request->email,
            'password' => $request->password, //El mutador encriptará automáticamente
            'is_admin' => $isAdmin, // Asignar admin al primer usuario registrado
        ]);

        auth()->login($usuario);

        if($usuario->is_admin){
            return redirect()->route('dashboard.index')->with('success', 'Registro exitoso. Bienvenido, Admin ' . $usuario->nombre . '!');
        } else {
        return redirect()->route('mascotas.index')->with('success', 'Registro exitoso. Bienvenido, ' . $usuario->nombre . '!');
    }
        //Iniciar sesión automáticamente
        auth()->login($usuario);

        return redirect()->route('dashboard.index')->with('success', 'Registro exitoso. Bienvenido, ' . $usuario->nombre . '!');
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

            $user = Auth::user();

            try {
                \Mail::to($user->email)->send(new \App\Mail\AlertaLoginCorreo($user));
            } catch (\Exception $e) {
                \Log::error('Error enviando correo: ' . $e->getMessage());
            }

            if($user->is_admin){
                return redirect()->route('dashboard.index')->with('success', 'Inicio de sesión exitoso. Bienvenido, Admin ' . $user->nombre . '!');
            } else {
            return redirect()->route('mascotas.index')
            ->with('success', 'Inicio de sesión exitoso. Bienvenido, ' . Auth::user()->nombre . '!');
            }
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

    public function adminDashboard(){
    return view('admin.dashboard'); 

    }
}
