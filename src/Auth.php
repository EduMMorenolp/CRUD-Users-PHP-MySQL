<?php
require_once 'db.php';
require_once 'funciones.php';

class Auth {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Registrar un nuevo usuario
    public function register($nombre, $email, $password, $telefono, $rol = 'usuario') {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nombre, email, password, telefono, rol) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nombre, $email, $hashedPassword, $telefono, $rol]);
    }

    // Iniciar sesión
    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }

    // Cerrar sesión
    public function logout() {
        session_destroy();
    }
}
?>