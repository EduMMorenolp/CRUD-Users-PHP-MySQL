<?php
class Router
{
    private $routes = [];

    public function addRoute($method, $endpoint, $callback)
    {
        $this->routes[] = [
            'method' => $method,
            'endpoint' => $endpoint,
            'callback' => $callback
        ];
    }

    public function handleRequest()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $endpoint = $_GET['endpoint'] ?? '/';

        echo "Método: $method\n";
        echo "Endpoint: $endpoint\n";

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['endpoint'] === $endpoint) {
                call_user_func($route['callback']);
                return;
            }
        }

        http_response_code(404);
        echo json_encode(['error' => 'Endpoint no encontrado']);
    }
}
?>