<?php
session_start();

class AuthMiddleware
{
    public static function requireLogin()
    {
        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Debes iniciar sesión para acceder a este recurso']);
            exit;
        }
    }

    public static function requireAdmin()
    {
        self::requireLogin();
        if ($_SESSION['user']['rol'] !== 'admin') {
            http_response_code(403);
            echo json_encode(['error' => 'Acceso denegado. Debes ser administrador']);
            exit;
        }
    }
}
?>