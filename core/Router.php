<?php

class Router
{
    protected $routes = [];

    public function get($uri, $controller)
    {
        $this->routes["GET"][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes["POST"][$uri] = $controller;
    }

    public function dispatch()
    {
        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

        // Remove a pasta do projeto (ex: /sistema_financeiro_produtividade)
        $basePath = '/sistema_financeiro_produtividade';
        $uri = str_replace($basePath, '', $uri);

        $uri = rtrim($uri, '/') ?: '/';
        $method = $_SERVER["REQUEST_METHOD"];
        if (isset($this->routes[$method][$uri])) {
            $controllerAction = explode("@", $this->routes[$method][$uri]);
            [$controllerName, $actionName] = $controllerAction;

            $controllerFile = __DIR__ . "/../app/Controllers/{$controllerName}.php";
            if (!file_exists($controllerFile)) {
                die("Controller '{$controllerName}' não encontrado.");
            }

            require_once $controllerFile;
            $controller = new $controllerName();

            if (!method_exists($controller, $actionName)) {
                die("Método '{$actionName}' não existe em {$controllerName}");
            }

            $controller->$actionName();
        } else {
            http_response_code(404);
            echo "404 - Página não encontrada";
        }
    }

}

