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
        $requestUri = strtok($_SERVER['REQUEST_URI'], '?');

        echo "Método: $method\n";
        echo "Endpoint: $requestUri\n";

        foreach ($this->routes as $route) {
            // Convertir el endpoint en una expresión regular
            $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^\/]+)', $route['endpoint']);
            if (preg_match('#^' . $pattern . '$#', $requestUri, $matches)) {
                // Extraer los valores de los parámetros dinámicos
                $params = [];
                foreach ($matches as $key => $value) {
                    if (!is_int($key)) {
                        $params[$key] = $value;
                    }
                }
                if ($route['method'] === $method) {
                    call_user_func_array($route['callback'], array_values($params));
                    return;
                }
            }
        }

        http_response_code(404);
        echo json_encode(['error' => 'Endpoint no encontrado']);
    }
}
?>