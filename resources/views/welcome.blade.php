<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi proyecto</title>
</head>
<body>
    @extends('layouts.app')

        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <div class="container">
                <a class="navbar-brand" href="#"> <img src="/images/logo.png" alt="Logo" width="40" height="40" class="d-inline-block align-text-top"> Huellitas de amor</a>
                <a href="{{ route('login') }}" class="btn btn-light">Iniciar sesión</a>
            </div>
        </nav>

        <!-- HERO -->
        <div class="container mt-5">
            <div class="text-center p-5 bg-light rounded shadow">
                <h1 class="display-4">Encuentra a tu nuevo mejor amigo 🐶🐱</h1>
                <p class="lead">Dale una segunda oportunidad a una mascota que necesita amor</p>
                <a href="{{ url('/mascotas') }}" class="btn btn-success btn-lg">
                    Ver Mascotas
                </a>
            </div>
        </div>

        <!-- MASCOTAS DESTACADAS -->
        <div class="container mt-5">
        <h2 class="mb-4 text-center">🐾 Mascotas agregadas recientemente</h2>
        <div class="row">
            @foreach($mascotas as $mascota)
                <div class="col-md-4 mb-4">
                    <div class="card shadow h-100">
                        <img src="{{ $mascota->foto }} "class="card-img-top" style="height:250px; object-fit:cover;" alt="{{ $mascota->nombre }}">
                        <div class="card-body">
                            <h5>{{ $mascota->nombre }}</h5>
                            <p>{{ $mascota->especie }} • {{ $mascota->edad }} años</p>
                            <a href="{{ url('/mascotas') }}" class="btn btn-primary">
                                Adóptame
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- CÓMO ADOPTAR -->
    <div class="container mt-5">
        <h2 class="text-center fw-bold mb-5 text-primary">
            🐾 ¿Cómo adoptar?
        </h2>

        <div class="row text-center">
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0 p-4 h-100 paso-card text-center">
                    <span class="badge bg-light text-dark mb-3 px-3 py-2">Paso 1</span>
                    <div class="d-flex justify-content-center mb-3">
                        <i class="fa-solid fa-magnifying-glass fa-3x text-primary"></i>
                    </div>

                    <h5 class="fw-bold">Busca</h5>
                    <p class="text-muted">Encuentra la mascota ideal para ti.</p>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0 p-4 h-100 paso-card text-center">
                    <span class="badge bg-light text-dark mb-2">Paso 2</span>
                    <div class="d-flex justify-content-center mb-3">
                        <i class="fa-solid fa-pen-to-square fa-3x text-success mb-3"></i>
                    </div>
                    <h5 class="fw-bold">Solicita</h5>
                    <p class="text-muted">Llena el formulario de adopción.</p>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0 p-4 h-100 paso-card text-center">
                    <span class="badge bg-light text-dark mb-2">Paso 3</span>
                    <div class="d-flex justify-content-center mb-3">
                        <i class="fa-solid fa-hourglass-half fa-3x text-warning mb-3"></i>
                    </div>
                    <h5 class="fw-bold">Espera</h5>
                    <p class="text-muted">Revisamos tu solicitud.</p>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card shadow-sm border-0 p-4 h-100 paso-card text-center">
                    <span class="badge bg-light text-dark mb-2">Paso 4</span>
                    <div class="d-flex justify-content-center mb-3">
                        <i class="fa-solid fa-heart fa-3x text-danger mb-3"></i>
                    </div>
                    <h5 class="fw-bold">Adopta</h5>
                    <p class="text-muted">Llévala contigo a casa</p>
                </div>
            </div>

        </div>
    </div>

    <!-- DATO CURIOSO DEL DÍA -->
    @if($datoCurioso)
    <div class="container mt-5">

        <div class="card shadow-lg border-0 text-center p-5 bg-light rounded-4">

            <h2 class="mb-3">🐾 Dato curioso del día</h2>

            <!-- ANIMAL -->
            <h5 class="text-muted mb-3">
                Sobre {{ $animalR == 'dog' ? 'Perros 🐶' : 'Gatos 🐱' }}
            </h5>

            <!-- TEXTO -->
            <p class="fs-6 text-muted">
                EN: "{{ $datoCurioso['fact'] ?? '' }}"
            </p>

            <p class="fs-5 fw-semibold">
                ES: "{{ $datoTraducido ?? 'No disponible' }}"
            </p>

            <!-- BOTÓN -->
            <div class="mt-4">
                <a href="{{ route ('home') }}" class="btn btn-outline-primary px-4" >
                    <i class="fa-solid fa-arrows-rotate"></i>
                    Ver otro dato
                </a>
            </div>

        </div>

    </div>
    @endif

</body>
</html>