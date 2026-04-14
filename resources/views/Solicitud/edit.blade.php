@extends('layouts.app')

@section('title', 'Gestionar Solicitud')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white py-3">
                    <h4 class="mb-0 text-center"><i class="fa-solid fa-user-gear me-2"></i> Revisar Solicitud</h4>
                </div>
                <div class="card-body p-4">
                    {{-- Información de la Solicitud --}}
                    <div class="mb-4">
                        <h5 class="text-primary border-bottom pb-2">Detalles del Solicitante</h5>
                        <p class="mb-1"><strong>Nombre:</strong> {{ $solicitud->usuario->nombre }} {{ $solicitud->usuario->apellido }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $solicitud->usuario->email }}</p>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-primary border-bottom pb-2">Mascota de Interés</h5>
                        <p class="mb-1"><strong>Nombre:</strong> {{ $solicitud->mascota->nombre }}</p>
                        <p class="mb-3"><strong>Especie:</strong> {{ $solicitud->mascota->especie }}</p>
                    </div>

                    <div class="mb-4 p-3 bg-light rounded">
                        <h6 class="fw-bold">Motivo de la Adopción:</h6>
                        <p class="fst-italic mb-0">"{{ $solicitud->motivo }}"</p>
                    </div>

                    <hr>

                    {{-- Formulario de Actualización de Estado --}}
                    <form action="{{ route('solicitudes.update', $solicitud->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="estado" class="form-label fw-bold">Cambiar Estado de la Solicitud:</label>
                            <select name="estado" id="estado" class="form-select form-select-lg">
                                <option value="Pendiente" {{ $solicitud->estado == 'Pendiente' ? 'selected' : '' }}>⏳ Pendiente</option>
                                <option value="Aprobada" {{ $solicitud->estado == 'Aprobada' ? 'selected' : '' }}>✅ Aprobar Adopción</option>
                                <option value="Rechazada" {{ $solicitud->estado == 'Rechazada' ? 'selected' : '' }}>❌ Rechazar Solicitud</option>
                            </select>
                            <div class="form-text mt-2 text-muted">
                                Al cambiar el estado, el usuario podrá ver la actualización en su panel.
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fa-solid fa-floppy-disk me-2"></i> Guardar Cambios
                            </button>
                            <a href="{{ route('solicitudes.index') }}" class="btn btn-light">
                                <i class="fa-solid fa-rotate-left me-1"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection