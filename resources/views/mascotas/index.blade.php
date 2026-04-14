@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fa-solid fa-paw"></i> Lista de Mascotas</h2>
    <div class="d-flex gap-2">
        <a href="{{ route('mascotas.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Registrar Nueva Mascota
        </a>
        @if (auth()->check() && auth()->user()->is_admin)
            <a href="{{ route('dashboard.index') }}" class="btn btn-secondary">
                <i class="fa-solid fa-arrow-left"></i> Volver al Dashboard
            </a>
        @endif
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>Nombre</th>
            <th>Especie</th>
            <th>Raza</th>
            <th>Edad</th>
            <th>Género</th>
            <th>Tamaño</th>
            <th>Estado</th>
            <th class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($mascotas as $mascota)
        <tr>
            <td>{{ $mascota->nombre }}</td>
            <td>{{ $mascota->especie }}</td>
            <td>{{ $mascota->raza }}</td>
            <td>{{ $mascota->edad }} años</td>
            <td>{{ $mascota->genero }}</td>
            <td>{{ $mascota->tamano }}</td>
            <td><span class="badge {{ $mascota->estado == 'Disponible' ? 'bg-success' : 'bg-secondary' }}">{{ $mascota->estado }}</span></td>
            <td class="text-center">
                {{-- BOTÓN DE ADOPCIÓN (Para todos los usuarios logueados) --}}
                <a href="{{ route('solicitudes.create', ['mascota_id' => $mascota->id]) }}" class="btn btn-success btn-sm">
                    <i class="fa-solid fa-heart"></i> Adoptar
                </a>

                {{-- ACCIONES DE EDICIÓN Y BORRADO (Opcional: puedes envolver esto en un @if admin) --}}
                <a href="{{ route('mascotas.edit', $mascota->id) }}" class="btn btn-warning btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>
                
                <form action="{{ route('mascotas.destroy', $mascota->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar esta mascota?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center py-4">No hay mascotas registradas aún.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- El logout se queda aquí fuera, eso está bien --}}
<form action="{{ route('logout') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-danger mb-3"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</button>
</form>
@endsection