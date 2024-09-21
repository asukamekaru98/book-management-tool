<?php

class isbnParser
{

    function __construct($isbn)
    {

        if ($this->isValidIsbn($isbn)) {
        }
    }

    function parseIsbnCode($isbn)
    {
        return new self($isbn);
    }

    function isValidIsbn($isbn)
    {
        // ISBN形式のチェック
        return preg_match('/^\d{3}-\d{1,5}-\d{1,7}-\d{1,7}-\d{1}$/', $isbn);
    }
}
