<?php
require_once __DIR__ . '/BaseModel.php';

class Usuario extends BaseModel
{

    // Obtener todos los usuarios
    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM usuarios WHERE deleted_at IS NULL");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo usuario
    public function create($nombre, $email, $password, $telefono, $rol = 'usuario')
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nombre, email, password, telefono, rol) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nombre, $email, $hashedPassword, $telefono, $rol]);
    }

    // Actualizar un usuario
    public function update($id, $nombre, $email, $telefono)
    {
        $stmt = $this->pdo->prepare("UPDATE usuarios SET nombre = ?, email = ?, telefono = ? WHERE id = ?");
        return $stmt->execute([$nombre, $email, $telefono, $id]);
    }

    // Eliminar un usuario (borrado lógico)
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("UPDATE usuarios SET deleted_at = NOW() WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Restaurar un usuario (borrado lógico)
    public function restore($id)
    {
        $stmt = $this->pdo->prepare("UPDATE usuarios SET deleted_at = NULL WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Obtener usuario por ID
    public function getById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = ? AND deleted_at IS NULL");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obtener usuario por email
    public function getByEmail(string $email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ? AND deleted_at IS NULL");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>