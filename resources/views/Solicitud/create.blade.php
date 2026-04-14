@extends('layouts.app')

@section('title', 'Enviar Solicitud de Adopción')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-success text-white text-center py-3">
                    <h4 class="mb-0"><i class="fa-solid fa-heart me-2"></i> Solicitud para {{ $mascota->nombre }}</h4>
                </div>
                <div class="card-body p-4">
                    {{-- Información breve de la mascota para que el usuario esté seguro --}}
                    <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
                        <i class="fa-solid fa-circle-info fa-2x me-3"></i>
                        <div>
                            Estás solicitando la adopción de un <strong>{{ $mascota->especie }}</strong> de raza <strong>{{ $mascota->raza }}</strong>.
                        </div>
                    </div>

                    <form action="{{ route('solicitudes.store') }}" method="POST">
                        @csrf
                        
                        {{-- Campo oculto para enviar el ID de la mascota --}}
                        <input type="hidden" name="mascota_id" value="{{ $mascota->id }}">

                        <div class="mb-3">
                            <label for="motivo" class="form-label fw-bold">¿Por qué quieres adoptar a {{ $mascota->nombre }}?</label>
                            <textarea 
                                class="form-control @error('motivo') is-invalid @enderror" 
                                id="motivo" 
                                name="motivo" 
                                rows="5" 
                                placeholder="Cuéntanos un poco sobre el hogar que le darás, tu experiencia con mascotas, etc."
                                required>{{ old('motivo') }}</textarea>
                            
                            @error('motivo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Mínimo 10 caracteres. Sé lo más detallado posible.</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fa-solid fa-paper-plane me-2"></i> Enviar Solicitud
                            </button>
                            <a href="{{ route('mascotas.index') }}" class="btn btn-light text-muted">
                                Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection