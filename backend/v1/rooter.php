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
        $viewed_flag = $httpMngr->getViewedFlag();
        $data = $httpMngr->getData();
        $format = $httpMngr->getFormat();

        if (isset($this->resourceCtrlers[$resource])) {
            return $this->resourceCtrlers[$resource]->handle($method, $isbn, $format, $viewed_flag, $data);
        }

        return $this->handleNotFound();
    }

    private function handleNotFound()
    {
        throw new BadFunctionCallException("Bad Function", NOT_FOUND_404);
    }
}
