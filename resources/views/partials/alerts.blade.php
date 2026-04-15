@if(session('success'))
    <div id="alerta" class="alert alert-success alert-dismissible d-flex align-items-center fade show">
        <i class="fa-solid fa-check-circle me-2"></i>
        <strong class ="mx-2">Éxito </strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>

        setTimeout(() => {
            let alertElement = document.getElementById('alerta');
            alertElement.classList.remove('show');
            alertElement.classList.add('fade');
                setTimeout(() => alertElement.remove(), 500);
        }, 4000);

    </script>

@endif

{{-- Alerta de Advertencia (Warning) --}}
@if(session('warning'))
    <div id="alerta-warning"class="alert alert-warning alert-dismissible d-flex align-items-center fade show">
        <i class="fa-solid fa-triangle-exclamation me-2"></i>
        <strong class="mx-2">Atención</strong> {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<script>
setTimeout(() => {
    let success = document.getElementById('alerta');
    if (success) {
        success.classList.remove('show');
        success.classList.add('fade');
        setTimeout(() => success.remove(), 500);
    }

    let warning = document.getElementById('alerta-warning');
    if (warning) {
        warning.classList.remove('show');
        warning.classList.add('fade');
        setTimeout(() => warning.remove(), 500);
    }
}, 4000);
</script>