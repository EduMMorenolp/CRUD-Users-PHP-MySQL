<?php
class Request
{
    // Obtener el cuerpo de la solicitud (para POST, PUT, etc.)
    public static function getBody()
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    // Obtener los parámetros de la URL (para GET)
    public static function getQueryParams()
    {
        return $_GET;
    }

    // Obtener el método HTTP (GET, POST, PUT, DELETE, etc.)
    public static function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
?>