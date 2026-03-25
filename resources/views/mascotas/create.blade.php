@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between">
                    <h4><i class="fa-solid fa-paw"></i> Registrar Nueva Mascota</h4>
                    <a href="{{ route('mascotas.index') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-arrow-left"></i> Volver
                    </a>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('mascotas.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nombre *</label>
                                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Especie *</label>
                                <input type="text" name="especie" class="form-control @error('especie') is-invalid @enderror" value="{{ old('especie') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Raza *</label>
                                <input type="text" name="raza" class="form-control @error('raza') is-invalid @enderror" value="{{ old('raza') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Edad (años) *</label>
                                <input type="number" name="edad" class="form-control @error('edad') is-invalid @enderror" value="{{ old('edad') }}" min="0" max="50" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Género *</label>
                                <select name="genero" class="form-select @error('genero') is-invalid @enderror" required>
                                    <option value="">Seleccionar</option>
                                    <option value="Macho" {{ old('genero') == 'Macho' ? 'selected' : '' }}>Macho</option>
                                    <option value="Hembra" {{ old('genero') == 'Hembra' ? 'selected' : '' }}>Hembra</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tamaño *</label>
                                <select name="tamano" class="form-select @error('tamano') is-invalid @enderror" required>
                                    <option value="">Seleccionar</option>
                                    <option value="Pequeño" {{ old('tamano') == 'Pequeño' ? 'selected' : '' }}>Pequeño</option>
                                    <option value="Mediano" {{ old('tamano') == 'Mediano' ? 'selected' : '' }}>Mediano</option>
                                    <option value="Grande" {{ old('tamano') == 'Grande' ? 'selected' : '' }}>Grande</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">Descripción</label>
                                <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="4">{{ old('descripcion') }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Estado *</label>
                                <select name="estado" class="form-select @error('estado') is-invalid @enderror" required>
                                    <option value="Disponible" {{ old('estado', 'Disponible') == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                                    <option value="Adoptada" {{ old('estado') == 'Adoptada' ? 'selected' : '' }}>Adoptada</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Foto (URL)</label>
                                <input type="url" name="foto" class="form-control @error('foto') is-invalid @enderror" value="{{ old('foto') }}" placeholder="https://ejemplo.com/foto.jpg">
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-save"></i> Guardar Mascota
                            </button>
                            <a href="{{ route('mascotas.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
