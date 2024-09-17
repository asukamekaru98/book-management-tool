<?php
class HttpResourceParser
{
    private $resource;

    function __construct($request)
    {
        $this->resourceParse($request);
    }

    function resourceParse($request)
    {
        $this->resource = array_shift($request);
    }

    function getResource()
    {
        return $this->resource;
    }
}
