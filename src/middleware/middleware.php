<?php
session_start();

function isAdmin() {
    return isset($_SESSION['user']) && $_SESSION['user']['rol'] === 'admin';
}

function isLoggedIn() {
    return isset($_SESSION['user']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        redirect('/public/login.php');
    }
}

function requireAdmin() {
    if (!isAdmin()) {
        die("Acceso denegado. Debes ser administrador.");
    }
}

function redirect($url) {
    header("Location: $url");
    exit;
}
?>