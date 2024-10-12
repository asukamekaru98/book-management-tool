<?php



class Router
{
    private $resourceCtrlers = [];

    public function addRoute(string $resource, resourceController $resourceCtrler)
    {
        $this->resourceCtrlers[$resource] = $resourceCtrler;
    }

    public function dispatch(httpManager $httpMngr)
    {
        $resource = $httpMngr->getUriResource(1);
        $method = $httpMngr->getHTTPMethod();
        $isbn = $httpMngr->getBookISBN();
        $data = $httpMngr->getData();

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
