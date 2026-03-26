<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Se debe iniciar sesión primero');
        }

        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }
        return redirect()->route('mascotas.index')
            ->with('error', 'No tienes permisos de administrador para acceder a esta sección.');


{

    
}



    }
}
{
    // Si el usuario está logueado Y es admin, lo dejamos pasar
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Si no es admin, lo mandamos a la lista de mascotas con un error
        return redirect()->route('mascotas.index')
            ->with('error', 'No tienes permisos de administrador para acceder a esta sección.');
    
}



