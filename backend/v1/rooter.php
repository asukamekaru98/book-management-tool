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

        if (isset($this->routes[$resource])) {
            return $this->routes[$resource]->handle($method, $isbn, $data);
        }

        return $this->handleNotFound();
    }

    private function handleNotFound()
    {
        http_response_code(NOT_FOUND_404);
        throw new RuntimeException("Not Found");
    }
}
