<?php
require_once __DIR__ . '/../Models/Usuario.php';

class AuthController
{
    private $usuarioModel;

    public function __construct($pdo)
    {
        $this->usuarioModel = new Usuario($pdo);
    }

    public function register($data)
    {
        $nombre = $data['nombre'];
        $email = $data['email'];
        $password = $data['password'];
        $telefono = $data['telefono'];

        if ($this->usuarioModel->create($nombre, $email, $password, $telefono)) {
            echo json_encode(['message' => 'Usuario registrado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al registrar el usuario']);
        }
    }

    public function login($data)
    {
        $email = $data['email'];
        $password = $data['password'];

        $user = $this->usuarioModel->getByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            echo json_encode(['message' => 'Inicio de sesión exitoso']);
        } else {
            http_response_code(401);
            echo json_encode(['error' => 'Credenciales incorrectas']);
        }
    }

    public function logout()
    {
        session_destroy();
        echo json_encode(['message' => 'Sesión cerrada correctamente']);
    }
}
?>