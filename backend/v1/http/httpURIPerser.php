<?php

class HttpURIPerser
{
    private array $aUri;

    function __construct($uri)
    {
        $this->requestParse($uri);
    }

    function requestParse($uri)
    {
        // クエリ以降を除去
        $uri = strtok($uri, '?');
        $this->aUri = explode('/', trim($uri, '/'));
    }

    /**
     * getter
     */
    function getUriResource()
    {
        return $this->aUri;
    }
}
