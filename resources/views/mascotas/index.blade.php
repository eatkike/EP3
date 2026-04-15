@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fa-solid fa-paw"></i> Lista de Mascotas</h2>
    <div class="d-flex gap-2">
        <a href="{{ route('mascotas.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Registrar Nueva Mascota
        </a>
        <a href="{{ route('solicitudes.index') }}" class="btn btn-info shadow-sm">
    <i class="fa-solid fa-envelope-open-text me-1"></i> Ver Solicitudes
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

@if($animalApi)
<div class="card shadow border-0 mb-4">
    <div class="card-body">
        <h3>🐾 Dato curioso del {{ $animalApi['name'] }}</h3>
        <p><strong>Dieta:</strong> {{ $animalApi['characteristics']['diet'] ?? 'No disponible' }}</p>
        <p><strong>Hábitat:</strong> {{ $animalApi['characteristics']['habitat'] ?? 'No disponible' }}</p>
        <p><strong>Vida promedio:</strong> {{ $animalApi['characteristics']['lifespan'] ?? 'No disponible' }}</p>
    </div>
</div>
@endif

<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>Foto</th>
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
            <td><img src="{{ $mascota->foto }}" width="80" height="80" style="object-fit: cover; border-radius: 10px;"></td>
            <td>{{ $mascota->nombre }}</td>
            <td>{{ $mascota->especie }}</td>
            <td>{{ $mascota->raza }}</td>
            <td>{{ $mascota->edad }} años</td>
            <td>{{ $mascota->genero }}</td>
            <td>{{ $mascota->tamano }}</td>
            <td><span class="badge {{ $mascota->estado == 'Disponible' ? 'bg-success' : 'bg-secondary' }}">{{ $mascota->estado }}</span></td>
            <td class="text-center">
                {{-- BOTÓN DE ADOPCIÓN (Para todos los usuarios logueados) --}}
                @if($mascota->estado === 'Disponible')
                    <a href="{{ route('solicitudes.create', ['mascota_id' => $mascota->id]) }}" class="btn btn-success btn-sm">
                        <i class="fa-solid fa-heart"></i> Adoptar
                    </a>
                @else
                    <button class="btn btn-secondary btn-sm" disabled>
                        <i class="fa-solid fa-heart-crack"></i> Ya fue adoptada
                    </button>
                @endif

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

<form action="{{ route('logout') }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-danger mb-3"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</button>
</form>
@endsection