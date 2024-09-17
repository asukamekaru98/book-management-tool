<?php
require_once('HttpRequestParser.php');
require_once('HttpResourceParser.php');

class HttpRequestManager
{
    private $method;    // リクエストメソッド
    private $bookISBN;  // 本のISBN
    private $request;   // リクエスト
    private $pathInfo;  // パス情報
    private $resource;  // リソース
    private $data;      // データ



    function __construct($method, $pathInfo)
    {

        $this->method = $method;
        $this->pathInfo = $pathInfo;

        $httpRequestParser = new HttpRequestParser($pathInfo);
        $this->request = $httpRequestParser->getRequest();


        $httpResourceParser = new HttpResourceParser($this->request);
        $this->resource = $httpResourceParser->getResource();

        $httpQueryParser = new HttpQueryParser($_GET['isbn']);
        $this->bookISBN = $httpQueryParser->getBookISBN();

        //$this->resource = array_shift($this->request);



        $this->data = json_decode(file_get_contents('php://input'), true);
    }

    /**
     * リクエストメソッドを取得
     * @return string リクエストメソッド
     */
    function getMethod()
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
    function getBookISBN()
    {
        return $this->bookISBN;
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
