<?php

class HttpRequestParser
{
    private $request;

    function __construct($pathInfo)
    {
        $this->requestParse($pathInfo);
    }

    function requestParse($pathInfo)
    {
        $this->request = explode('/', trim($pathInfo, '/'));
    }

    function getRequest()
    {
        return $this->request;
    }
}
