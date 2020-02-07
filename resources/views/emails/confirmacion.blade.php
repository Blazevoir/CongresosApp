<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verification Email</title>
</head>
<body>
    <h1> Hola, {{$user->name}}!</h1>
    <h3> Tu contraseña provisional es {{$user->name}}pass. No olvides cambiarla en cuanto te logees</h3>
    <h3> Pulsa en el siguiente enlace para verificar tu cuenta:</h3>
    <h3><a href="http://informatica.ieszaidinvergeles.org:9021/congresosApp/public/verify/{{$user->tokenNacho}}">Verificar cuenta</a></h3>
</body>
</html>