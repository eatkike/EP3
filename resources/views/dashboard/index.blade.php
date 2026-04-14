@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="mb-5"><i class="fa-solid fa-dashboard"></i> Panel Principal</h1>
            
            <div class="row g-4">
                <div class="col-md-6">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-primary btn-lg w-100 h-100 p-4">
                        <i class="fa-solid fa-users fa-2x mb-3 d-block"></i>
                        <h3>Gestión de Usuarios</h3>
                        <p>Ver, editar, eliminar y registrar nuevos usuarios</p>
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('mascotas.index') }}" class="btn btn-info btn-lg w-100 h-100 p-4">
                        <i class="fa-solid fa-paw fa-2x mb-3 d-block"></i>
                        <h3>Gestión de Mascotas</h3>
                        <p>Ver, editar, eliminar y registrar nuevas mascotas en adopción</p>
                    </a>
                </div>
            

            <div class="col-md-6">
                    <a href="{{ route('solicitudes.index') }}" class="btn btn-success btn-lg w-100 h-100 p-4">
                        <i class="fa-solid fa-envelope-open-text fa-2x mb-3 d-block"></i>
                        <h3>Gestión de Solicitudes</h3>
                        <p>Ver, editar, eliminar y registrar nuevas solicitudes de adopción</p>
                    </a>
                </div>
            </div>
            </div>

            <div class="mt-5">
                
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-lg">
                        <i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
