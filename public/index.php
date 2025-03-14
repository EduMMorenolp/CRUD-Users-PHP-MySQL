<?php
// Database
$pdo = require_once __DIR__ . '/../config/db.php';
// Routes
require_once __DIR__ . '/../app/Core/Router.php';
require_once __DIR__ . '/../app/Core/Request.php';
// Controllers
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/UserController.php';
require_once __DIR__ . '/../app/Controllers/AdminController.php';

$router = new Router();

// Rutas públicas
$router->addRoute('POST', '/auth/register', function () use ($pdo) {
    $authController = new AuthController($pdo);
    $authController->register(Request::getBody());
});

$router->addRoute('POST', '/auth/login', function () use ($pdo) {
    $authController = new AuthController($pdo);
    $authController->login(Request::getBody());
});

// Rutas protegidas (usuarios)
$router->addRoute('GET', '/users', function () use ($pdo) {
    AuthMiddleware::requireLogin();
    $userController = new UserController($pdo);
    $userController->getAllUsers();
});

$router->addRoute('PUT', '/users/update/{id}', function ($id) use ($pdo) {
    AuthMiddleware::requireLogin();
    $userController = new UserController($pdo);
    $userController->updateUser($id, Request::getBody());
});

$router->addRoute('DELETE', '/users/delete/{id}', function ($id) use ($pdo) {
    AuthMiddleware::requireLogin();
    $userController = new UserController($pdo);
    $userController->deleteUser($id);
});

// Rutas protegidas (admin)
$router->addRoute('GET', '/admin/allusers', function () use ($pdo) {
    $adminController = new AdminController($pdo);
    $adminController->getAllUsers();
});

$router->addRoute('PUT', '/admin/users/restore/{id}', function ($id) use ($pdo) {
    $adminController = new AdminController($pdo);
    $adminController->restoreUser($id);
});

$router->handleRequest();
?>