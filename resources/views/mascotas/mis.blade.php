@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fa-solid fa-user"></i> Mis Mascotas</h2>

    <div class="d-flex gap-2">
        <a href="{{ route('mascotas.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Registrar Mascota
        </a>

        <a href="{{ route('mascotas.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-eye"></i> Ver todas
        </a>
    </div>
</div>

{{-- ALERTAS --}}
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('warning'))
    <div class="alert alert-warning">{{ session('warning') }}</div>
@endif

{{-- TABLA --}}
<table class="table table-hover">
    <thead class="table-dark">
        <tr>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Especie</th>
            <th>Raza</th>
            <th>Edad</th>
            <th>Estado</th>
            <th class="text-center">Acciones</th>
        </tr>
    </thead>

    <tbody>
        @forelse($mascotas as $mascota)
        <tr>
            <td>
                <img src="{{ $mascota->foto }}" width="80" height="80"
                     style="object-fit: cover; border-radius: 10px;">
            </td>

            <td>{{ $mascota->nombre }}</td>
            <td>{{ $mascota->especie }}</td>
            <td>{{ $mascota->raza }}</td>
            <td>{{ $mascota->edad }} años</td>

            <td>
                <span class="badge {{ $mascota->estado == 'Disponible' ? 'bg-success' : 'bg-secondary' }}">
                    {{ $mascota->estado }}
                </span>
            </td>

            <td class="text-center">

                {{-- EDITAR --}}
                <a href="{{ route('mascotas.edit', $mascota->id) }}" class="btn btn-warning btn-sm">
                    <i class="fa-solid fa-pen-to-square"></i>
                </a>

                {{-- ELIMINAR --}}
                <form action="{{ route('mascotas.destroy', $mascota->id) }}"
                      method="POST"
                      style="display:inline;"
                      onsubmit="return confirm('¿Eliminar esta mascota?')">

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
            <td colspan="7" class="text-center py-4">
                No has registrado mascotas aún 🐾
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection