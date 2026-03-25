@if(session('success'))
    <div id="alerta" class="alert alert-success alert-dismissible d-flex align-items-center fade show">
        <i class="fa-solid fa-check-circle me-2"></i>
        <strong class ="mx-2">Sesión iniciada! </strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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