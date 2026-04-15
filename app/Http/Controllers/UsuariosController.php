<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;


class UsuariosController extends Controller
{
    /**
     * Consulta de informacion
     */
    public function index()
    {
        //Obtener todos los datos de la BD
        $usuarios = Usuarios::all();
        //Retornar la vista con los datos obtenidos
        return view('usuarios.index', compact('usuarios'));
    }

    /* Mostrar vista para el registro de un nuevo usuario */
    public function create()
    {
        //
        return view('usuarios.create');
    }

    /** Guardar la informacion del nuevo usuario en la BD*/
    public function store(Request $request)
    {
        //Validar los datos del formulario
        $request->validate(Usuarios::rules());

        //Crear el usuario - la contraseña se encripta automáticamente gracias al mutador
        Usuarios::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'password' => $request->password, //El mutador encriptará automáticamente
        ]);

        return redirect()->route('usuarios.create')->with('success', 'Usuario registrado exitosamente!');
    }

    /** Display the specified resource. */
    public function show(String $id)
    {
        $usuario = Usuarios::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $usuario = Usuarios::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $usuario = Usuarios::findOrFail($id);
        
        //Validar con regla unique ignorando el usuario actual
        $request->validate(Usuarios::rules(true, $id));

        //Preparar datos para actualizar
        $data = [
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'email' => $request->email,
        ];

        //Solo actualizar contraseña si se proporciona una nueva
        if ($request->filled('password')) {
            $data['password'] = $request->password; //El mutador encriptará automáticamente
        }

        $usuario->update($data);
        
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $usuario = Usuarios::findOrFail($id);
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente!');
    }
}
