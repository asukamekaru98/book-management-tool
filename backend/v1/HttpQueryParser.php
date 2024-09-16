<?php

class HttpQueryParser
{

    private $bookISBN;    // 本のID


    function __construct($request)
    {

        $this->bookISBN = array_shift($request);
    }

    function getBookISBN()
    {
        return $this->bookISBN;
    }
}
