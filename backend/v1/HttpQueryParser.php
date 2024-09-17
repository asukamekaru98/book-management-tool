<?php

class HttpQueryParser
{

    private $bookISBN;    // 本のID


    function __construct($query)
    {

        $this->bookISBN = isset($query) ? $query : null;
    }

    function getBookISBN()
    {
        return $this->bookISBN;
    }
}
