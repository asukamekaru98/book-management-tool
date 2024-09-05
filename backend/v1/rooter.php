<?php

class Router
{
    private $routes = [];

    public function addRoute($key, $controller)
    {
        $this->routes[$key] = $controller;
    }

    public function dispatch($data)
    {
        foreach ($this->routes as $key => $controller) {
            if (isset($data[$key])) {
                return $controller->handle($data[$key]);
            }
        }

        return $this->handleNotFound();
    }

    private function handleNotFound()
    {
        http_response_code(404);
        return "Not Found";
    }
}
