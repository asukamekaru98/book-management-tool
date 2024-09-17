<?php

class Router
{
    private $routes = [];

    public function addRoute($resource, $controller)
    {
        $this->routes[$resource] = $controller;
    }

    public function dispatch($resource, $method, $isbn, $data)
    {

        if (isset($routes[$resource])) {
            return $routes[$resource]->handle($method, $isbn, $data);
        }

        return $this->handleNotFound();
    }

    private function handleNotFound()
    {
        http_response_code(404);
        return "Not Found";
    }
}
