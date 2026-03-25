<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>
<body>
    
   @extends('layouts.app')

@section('content')
<div class="mb-4">
    <h2><i class="fa-solid fa-user-pen"></i> Editar: {{ $usuario->nombre }}</h2>
    <hr>
</div>

<form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $usuario->nombre }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Apellido</label>
            <input type="text" name="apellido" class="form-control" value="{{ $usuario->apellido }}" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Correo Electrónico</label>
        <input type="email" name="email" class="form-control" value="{{ $usuario->email }}" required>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">Actualizar Cambios</button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver</a>
    </div>
</form>
@endsection

</body>
</html>