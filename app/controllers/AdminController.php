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
        AuthMiddleware::requireAdmin(); // Verifica que el usuario sea administrador
        $users = $this->usuarioModel->getAll();
        echo json_encode($users);
    }

    // Obtener usuario por ID (solo para admin)
    public function getUserById($id)
    {
        AuthMiddleware::requireAdmin();
        $user = $this->usuarioModel->getById($id);
        if ($user) {
            echo json_encode($user);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Usuario no encontrado']);
        }
    }

    // Buscar usuarios con filtros (solo para admin)
    public function searchUsers($queryParams)
    {
        AuthMiddleware::requireAdmin();
        $filters = [];
        $params = [];

        if (!empty($queryParams['nombre'])) {
            $filters[] = "nombre LIKE ?";
            $params[] = '%' . $queryParams['nombre'] . '%';
        }
        if (!empty($queryParams['email'])) {
            $filters[] = "email LIKE ?";
            $params[] = '%' . $queryParams['email'] . '%';
        }
        if (!empty($queryParams['rol'])) {
            $filters[] = "rol = ?";
            $params[] = $queryParams['rol'];
        }

        $query = "SELECT * FROM usuarios WHERE deleted_at IS NULL";
        if (!empty($filters)) {
            $query .= " AND " . implode(" AND ", $filters);
        }

        $stmt = $this->usuarioModel->getPdo()->prepare($query);
        $stmt->execute($params);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($users);
    }

    // Actualizar un usuario (solo para admin)
    public function updateUser($id, $data)
    {
        AuthMiddleware::requireAdmin();
        $nombre = $data['nombre'] ?? null;
        $email = $data['email'] ?? null;
        $telefono = $data['telefono'] ?? null;
        $rol = $data['rol'] ?? null;

        if (!$nombre && !$email && !$telefono && !$rol) {
            http_response_code(400);
            echo json_encode(['error' => 'No se proporcionaron datos para actualizar']);
            return;
        }

        $stmt = $this->usuarioModel->getPdo()->prepare("UPDATE usuarios SET nombre = ?, email = ?, telefono = ?, rol = ? WHERE id = ?");
        if ($stmt->execute([$nombre, $email, $telefono, $rol, $id])) {
            echo json_encode(['message' => 'Usuario actualizado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al actualizar el usuario']);
        }
    }

    // Eliminar un usuario (borrado lógico, solo para admin)
    public function deleteUser($id)
    {
        AuthMiddleware::requireAdmin();
        if ($this->usuarioModel->delete($id)) {
            echo json_encode(['message' => 'Usuario eliminado correctamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al eliminar el usuario']);
        }
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