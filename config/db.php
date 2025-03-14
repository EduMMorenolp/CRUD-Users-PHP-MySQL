<?php
$host = 'localhost';
$dbname = 'crud_php';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Error al conectar con la base de datos: " . $e->getMessage(), 3, __DIR__ . '/../logs/error.log');
    die("Error al conectar con la base de datos.");
}

ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../logs/error.log');
return $pdo;
?>