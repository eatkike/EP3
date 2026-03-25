<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Usuarios</title>
</head>
<body>
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fa-solid fa-users"></i> Lista de Usuarios</h2>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
        <i class="fa-solid fa-user-plus"></i> Registrar Nuevo
    </a>
    <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger mb-3"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</button>
        </form>
</div>


<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>Nombre Completo</th>
            <th>Email</th>
            <th class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usuarios as $user)
        <tr>
            <td>{{ $user->nombre }} {{ $user->apellido }}</td>
            <td>{{ $user->email }}</td>
            <td class="text-center">
                <a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-warning btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>

                <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar usuario?')">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

        </tbody>

</body>
</html>