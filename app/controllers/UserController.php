<?php
require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/../Middleware/AuthMiddleware.php';

class UserController
{
    private $usuarioModel;

    public function __construct($pdo)
    {
        $this->usuarioModel = new Usuario($pdo);
    }

    // Obtener todos los usuarios
    public function getAllUsers()
    {
        echo json_encode($this->usuarioModel->getAll());
    }

    // Obtener usuario por ID
    public function getUserById($id)
    {
        $user = $this->usuarioModel->getById($id);
        if ($user) {
            echo json_encode($user);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Usuario no encontrado']);
        }
    }

    // Actualizar un usuario
    public function updateUser($id, $data)
    {
        $nombre = $data['nombre'];
        $email = $data['email'];
        $telefono = $data['telefono'];

        if ($this->usuarioModel->update($id, $nombre, $email, $telefono)) {
            echo json_encode(['message' => 'Usuario actualizado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al actualizar el usuario']);
        }
    }

    // Eliminar un usuario (borrado lógico)
    public function deleteUser($id)
    {
        if ($this->usuarioModel->delete($id)) {
            echo json_encode(['message' => 'Usuario eliminado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al eliminar el usuario']);
        }
    }
}
?>