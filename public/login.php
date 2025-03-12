<?php
require_once '../src/db.php';
require_once '../src/Auth.php';
require_once '../src/funciones.php';

$auth = new Auth($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($auth->login($email, $password)) {
        redirect('/public/index.php');
    } else {
        echo "Credenciales incorrectas.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <form method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required><br>

        <button type="submit">Iniciar Sesión</button>
    </form>
    <a href="register.php">Registrarse</a>
</body>
</html>