@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>
            <i class="fa-solid fa-clipboard-list me-2"></i> 
            {{ auth()->user()->is_admin ? 'Gestión de Solicitudes' : 'Mis Solicitudes de Adopción' }}
        </h2>
        <a href="{{ route('mascotas.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Volver a Mascotas
        </a>
    </div>

    @include('partials.alerts')

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            @if(auth()->user()->is_admin)
                                <th>Usuario</th>
                            @endif
                            <th>Mascota</th>
                            <th>Motivo</th>
                            <th>Fecha</th>
                            <th class="text-center">Estado</th>
                            @if(auth()->user()->is_admin)
                                <th class="text-center">Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($solicitudes as $solicitud)
                        <tr>
                            @if(auth()->user()->is_admin)
                                <td>
                                    <strong>{{ $solicitud->usuario->nombre }}</strong><br>
                                    <small class="text-muted">{{ $solicitud->usuario->email }}</small>
                                </td>
                            @endif
                            <td>
                                <span class="badge bg-info text-dark">{{ $solicitud->mascota->nombre }}</span>
                                <br><small>{{ $solicitud->mascota->especie }}</small>
                            </td>
                            <td>
                                <p class="small mb-0 text-truncate" style="max-width: 250px;" title="{{ $solicitud->motivo }}">
                                    {{ $solicitud->motivo }}
                                </p>
                            </td>
                            <td>{{ $solicitud->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">
                                @php
                                    $color = [
                                        'Pendiente' => 'bg-warning text-dark',
                                        'Aprobada' => 'bg-success',
                                        'Rechazada' => 'bg-danger'
                                    ][$solicitud->estado] ?? 'bg-secondary';
                                @endphp
                                <span class="badge {{ $color }}">{{ $solicitud->estado }}</span>
                            </td>
                            
                            @if(auth()->user()->is_admin)
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Gestionar
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <form action="{{ route('solicitudes.update', $solicitud->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="estado" value="Aprobada">
                                                <button type="submit" class="dropdown-item text-success"><i class="fa-solid fa-check me-2"></i>Aprobar</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('solicitudes.update', $solicitud->id) }}" method="POST">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="estado" value="Rechazada">
                                                <button type="submit" class="dropdown-item text-danger"><i class="fa-solid fa-xmark me-2"></i>Rechazar</button>
                                            </form>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form action="{{ route('solicitudes.destroy', $solicitud->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="dropdown-item text-muted" onclick="return confirm('¿Eliminar solicitud?')">
                                                    <i class="fa-solid fa-trash me-2"></i>Eliminar
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            @endif
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-inbox fs-1 mb-3"></i><br>
                                No hay solicitudes registradas.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection