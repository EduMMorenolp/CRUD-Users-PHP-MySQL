<?php
require_once 'db.php';

class Usuario
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Obtener todos los usuarios
    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM usuarios");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo usuario
    public function create($nombre, $email, $password, $telefono, $rol = 'usuario')
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nombre, email, password, telefono, rol) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nombre, $email, $hashedPassword, $telefono, $rol]);
    }

    // Obtener un usuario por ID
    public function getById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar un usuario
    public function update($id, $nombre, $email, $telefono)
    {
        $stmt = $this->pdo->prepare("UPDATE usuarios SET nombre = ?, email = ?, telefono = ? WHERE id = ?");
        return $stmt->execute([$nombre, $email, $telefono, $id]);
    }

    // Eliminar un usuario
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Restaurar usuario (borrado lógico)
    public function restore($id)
    {
        $stmt = $this->pdo->prepare("UPDATE usuarios SET deleted_at = NULL WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>