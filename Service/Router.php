<?php
namespace Service;

class Router
{
    private $routes = [];

    public function addRoute($method, $url, $handler)
    {
        $this->routes[] = [
            'method' => $method,
            'url' => trim($url, '/'),
            'handler' => $handler,
        ];
    }

    public function handleRequest()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUrl = trim($_SERVER['REQUEST_URI'], '/');
        $foundRoute = null;

        foreach ($this->routes as $route) {
            if ($route['method'] === $requestMethod && $route['url'] === $requestUrl) {
                $foundRoute = $route;
                break;
            }
        }

        if ($foundRoute) {
            $this->executeHandler($foundRoute['handler']);
        } else {
            $this->notFound();
        }
    }

    /**
     * @param array|string $handler
     * @return void
     */
    private function executeHandler(array|string $handler)
    {
        if (is_callable($handler)) {
            call_user_func($handler);
        } else if (is_array($handler)) {
            $controllerName = $handler[0];
            $methodName = $handler[1];

            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $methodName)) {
                    $controller->$methodName();
                } else {
                    $this->notFound();
                }
            } else {
                $this->notFound();
            }
        } else {
            $this->notFound();
        }
    }

    private function notFound()
    {
        header('HTTP/1.1 404 Not Found');
        echo '404 Not Found';
    }
}

?>
