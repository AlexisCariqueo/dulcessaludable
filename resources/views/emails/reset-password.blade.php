<!DOCTYPE html>
<html>
<head>
    <title>Restablecimiento de Contraseña</title>
</head>
<body>
    <h2>Hola,</h2>
    <p>Has solicitado un restablecimiento de contraseña. Para continuar con el proceso, haz clic en el enlace que se proporciona a continuación.</p>

    <a href="{{ url('password/reset', $token) }}">Restablecer Contraseña</a>

    <p>Si no solicitaste el restablecimiento de tu contraseña, por favor ignora este correo electrónico.</p>
</body>
</html>
