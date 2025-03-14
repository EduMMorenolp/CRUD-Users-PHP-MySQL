<?php
session_start();

class RoleMiddleware
{
    public static function requireRole($role)
    {
        AuthMiddleware::requireLogin(); // Primero verifica si el usuario está autenticado

        if ($_SESSION['user']['rol'] !== $role) {
            http_response_code(403);
            echo json_encode(['error' => "Acceso denegado. Debes tener el rol de '$role'"]);
            exit;
        }
    }
}
?>