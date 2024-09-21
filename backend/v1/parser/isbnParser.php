<?php

class isbnParser
{

    function __construct($isbn)
    {

        if ($this->isValidIsbn($isbn)) {
            http_response_code(NOT_ACCEPTABLE_406);
            echo json_encode(['message' => '無効なISBNコードです']);
            throw new RuntimeException("無効なISBNコードです");
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
