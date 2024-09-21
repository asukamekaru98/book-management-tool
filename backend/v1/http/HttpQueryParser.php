<?php
require_once(__DIR__ . '/../constant/const_uri.php');

class HttpQueryParser
{
    private $queries = [];

    function __construct()
    {
        //echo $query;

        //$this->queries[URI_QUERY_ISBN] = $query[URI_QUERY_ISBN] ?? INIT_URI_QUERY_ISBN;
        //$this->queries[URI_QUERY_DATA_FORMAT] = $query[URI_QUERY_DATA_FORMAT] ?? INIT_URI_QUERY_DATA_FORMAT;

        $this->queries[URI_QUERY_ISBN] = $_GET[URI_QUERY_ISBN] ?? INIT_URI_QUERY_ISBN;
        $this->queries[URI_QUERY_DATA_FORMAT] = $_GET[URI_QUERY_DATA_FORMAT] ?? INIT_URI_QUERY_DATA_FORMAT;
    }


    /**
     * ISBNを取得する
     */
    function getQueryISBN()
    {
        return $this->queries[URI_QUERY_ISBN];
    }

    /**
     * フォーマット(JSON or XML)を取得する
     */
    function getQueryFormat()
    {
        return $this->queries[URI_QUERY_DATA_FORMAT];
    }


    /**
     * 全クエリを取得する
     */
    function getQueries()
    {
        return $this->queries;
    }
}
