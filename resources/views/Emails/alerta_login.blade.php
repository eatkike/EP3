<!DOCTYPE html>
<html lang="en">
<head>
<style>
    .container{
        font-family: Arial;
        background: #f2f2f2;
        padding: 20px;
        align-items: center;
    }
    .content{
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .btn{
        background: blue;
        color: #f4fff4;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
    }
</style>
</head>
<body>
<center>
    <div class="container">
        <div class="content">
            <h1>Nuevo Inicio de Sesión :o</h1>
            <p>Hola, {{ $usuario->name }},</p>
            <p>Se ha detectado un nuevo inicio de sesión en tu cuenta.</p>
            <a href="{{ route ('login') }}" class="btn" style="color: white;">Haz clic aquí para ver tu cuenta</a>


            <p style="margin-top: 20px;">
                Si no fuiste tú, por favor cambia tu contraseña de inmediato.</p>

        </div>
    </div>
</center>




</body>
</html>