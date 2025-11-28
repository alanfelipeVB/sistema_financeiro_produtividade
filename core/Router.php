<?php

class Router
{
    protected $routes = [];

    public function get($uri, $controller)
    {
        $this->addRoute("GET", $uri, $controller);
    }

    public function post($uri, $controller)
    {
        $this->addRoute("POST", $uri, $controller);
    }

    private function addRoute($method, $uri, $controller)
    {
        // Converte {param} para regex capturável
        $pattern = preg_replace('/\{(\w+)\}/', '([^/]+)', $uri);

        // Guarda rota com pattern e parâmetros
        $this->routes[$method][] = [
            'uri' => $uri,
            'pattern' => '#^' . $pattern . '$#',
            'controller' => $controller,
            'params' => $this->extractParamNames($uri),
        ];
    }

    private function extractParamNames($uri)
    {
        preg_match_all('/\{(\w+)\}/', $uri, $matches);
        return $matches[1];
    }

    public function dispatch()
    {
        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

        // Remove base path
        $basePath = '/sistema_financeiro_produtividade';
        $uri = str_replace($basePath, '', $uri);

        $uri = rtrim($uri, '/') ?: '/';
        $method = $_SERVER["REQUEST_METHOD"];

        if (!isset($this->routes[$method])) {
            http_response_code(404);
            echo "404 - Método não encontrado";
            return;
        }

        foreach ($this->routes[$method] as $route) {
            if (preg_match($route['pattern'], $uri, $matches)) {

                // Remove grupo completo
                array_shift($matches);

                // Junta nomes com valores
                $params = array_combine($route['params'], $matches);

                [$controllerName, $actionName] = explode("@", $route['controller']);

                $controllerFile = __DIR__ . "/../app/Controllers/{$controllerName}.php";
                if (!file_exists($controllerFile)) {
                    die("Controller '{$controllerName}' não encontrado.");
                }

                require_once $controllerFile;
                $controller = new $controllerName();

                if (!method_exists($controller, $actionName)) {
                    die("Método '{$actionName}' não existe em {$controllerName}");
                }

                // Chama o controller passando os parâmetros
                return $controller->$actionName($params);
            }
        }

        http_response_code(404);
        echo "404 - Página não encontrada";
    }
}
