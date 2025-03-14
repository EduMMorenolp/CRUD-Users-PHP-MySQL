<?php
require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/../Middleware/AuthMiddleware.php';

class AdminController
{
    private $usuarioModel;

    public function __construct($pdo)
    {
        $this->usuarioModel = new Usuario($pdo);
    }

    // Obtener todos los usuarios (solo para admin)
    public function getAllUsers()
    {
        AuthMiddleware::requireAdmin();
        echo json_encode($this->usuarioModel->getAll());
    }

    // Restaurar un usuario eliminado (solo para admin)
    public function restoreUser($id)
    {
        AuthMiddleware::requireAdmin();
        if ($this->usuarioModel->restore($id)) {
            echo json_encode(['message' => 'Usuario restaurado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al restaurar el usuario']);
        }
    }
}
?>