<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
</head>
<body>
    
    @extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2><i class="fa-solid fa-user-plus"></i> Nuevo Registro</h2>
    <hr>
</div>

<form action="{{ route('usuarios.store') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Apellido</label>
            <input type="text" name="apellido" class="form-control" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Correo Electrónico</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-4">
        <label class="form-label">Contraseña</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-success">Guardar Usuario</button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
     <div class="form-check">
            <input type="checkbox" name="is_admin" value="1" class="form-check-input">
            <label class="form-check-label" for="is_admin">Registrar como Administrador</label>
        </div>
</form>
@endsection
</body>
</html>