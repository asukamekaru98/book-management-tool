<?php

class Router
{
    private $resourceCtrlers = [];

    public function addRoute(string $resource, resourceController $resourceCtrler)
    {
        $this->resourceCtrlers[$resource] = $resourceCtrler;
    }

    public function dispatch($resource, $method, $isbn, $data)
    {

        if (isset($this->resourceCtrlers[$resource])) {
            return $this->resourceCtrlers[$resource]->handle($method, $isbn, $data);
        }

        return $this->handleNotFound();
    }

    private function handleNotFound()
    {
        http_response_code(NOT_FOUND_404);
        throw new BadFunctionCallException("Bad Function");
    }
}
