<?php

/**
 * Función para redirigir al usuario a una URL específica.
 *
 * @param string $url La URL a la que se redirigirá al usuario.
 */
function redirect($url)
{
    header("Location: $url");
    exit;
}

/**
 * Función para validar un email.
 *
 * @param string $email El email a validar.
 * @return bool True si el email es válido, False en caso contrario.
 */
function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Función para mostrar un mensaje de error y detener la ejecución del script.
 *
 * @param string $message El mensaje de error a mostrar.
 */
function showError($message)
{
    echo "<div style='color: red; font-weight: bold;'>Error: $message</div>";
    exit;
}

/**
 * Función para generar un mensaje de éxito.
 *
 * @param string $message El mensaje de éxito a mostrar.
 */
function showSuccess($message)
{
    echo "<div style='color: green; font-weight: bold;'>$message</div>";
}

/**
 * Función para verificar si un email ya existe en la base de datos.
 *
 * @param PDO $pdo Conexión a la base de datos.
 * @param string $email El email a verificar.
 * @return bool True si el email existe, False en caso contrario.
 */
function emailExists($pdo, $email)
{
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetchColumn() > 0;
}

/**
 * Función para formatear una fecha en un formato legible.
 *
 * @param string $date Fecha en formato de base de datos (Y-m-d H:i:s).
 * @return string Fecha formateada.
 */
function formatDate($date)
{
    return date('d/m/Y H:i', strtotime($date));
}

/**
 * Función para generar un token CSRF (Cross-Site Request Forgery).
 *
 * @return string Token generado.
 */
function generateCsrfToken()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Función para validar un token CSRF.
 *
 * @param string $token Token recibido desde el formulario.
 * @return bool True si el token es válido, False en caso contrario.
 */
function validateCsrfToken($token)
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}