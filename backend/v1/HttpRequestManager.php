<?php
require_once('HttpRequestParser.php');
require_once('HttpResourceParser.php');

class HttpRequestManager
{
    private $method;    // リクエストメソッド
    private $bookId;    // 本のID
    private $request;   // リクエスト
    private $pathInfo;  // パス情報
    private $resource;  // リソース
    private $data;      // データ
    private $httpRequestParser;
    private $httpResourceParser;


    function __construct($method, $pathInfo)
    {
        $this->method = $method;
        $this->pathInfo = $pathInfo;

        $httpRequestParser = new HttpRequestParser($pathInfo);
        $httpResourceParser = new HttpResourceParser($httpRequestParser->getRequest());

        //$this->resource = array_shift($this->request);
        $this->bookId = array_shift($this->request);
        $this->data = json_decode(file_get_contents('php://input'), true);
    }

    /**
     * リクエストメソッドを取得
     * @return string リクエストメソッド
     */
    function getMethood()
    {
        return $this->method;
    }

    /**
     * パス情報を取得
     * @return string パス情報
     */
    function getPathInfo()
    {
        return $this->pathInfo;
    }

    /**
     * リクエストを取得
     * @return array リクエスト
     */
    function getRequest()
    {
        return $this->request;
    }

    /**
     * リソースを取得
     * @return string リソース
     */
    function getResource()
    {
        return $this->resource;
    }

    /**
     * IDを取得
     * @return string ID
     */
    function getId()
    {
        return $this->bookId;
    }

    /**
     * データを取得
     * @return array データ
     */
    function getData()
    {
        return $this->data;
    }
}
