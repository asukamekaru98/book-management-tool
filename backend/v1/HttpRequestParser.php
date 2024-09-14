<?php
class HttpRequestParser
{
    private $method;
    private $id;
    private $request;
    private $pathInfo;
    private $resource;
    private $data;

    function __construct($method, $pathInfo)
    {
        $this->method = $method;
        $this->pathInfo = $pathInfo;


        $this->request = explode('/', trim($this->pathInfo, '/'));
        $this->resource = array_shift($this->request);
        $this->id = array_shift($this->request);
        $this->data = json_decode(file_get_contents('php://input'), true);
    }
}
