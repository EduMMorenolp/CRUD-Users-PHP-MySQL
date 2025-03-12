<?php
require_once '../src/db.php';
require_once '../src/Auth.php';
require_once '../src/funciones.php';

$auth = new Auth($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];

    if ($auth->register($nombre, $email, $password, $telefono)) {
        redirect('/public/login.php');
    } else {
        echo "Error al registrar el usuario.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Registro</h1>
    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono"><br>

        <button type="submit">Registrarse</button>
    </form>
    <a href="login.php">Iniciar Sesión</a>
</body>
</html>