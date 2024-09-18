<?php
require_once('httpURIPerser.php');
require_once('HttpResourceParser.php');
require_once('HttpQueryParser.php');

class httpManager
{
    private $httpMethod;    // リクエストメソッド

    private array $aQueries = [];
    private $requestURI;
    private array $aUriResource;

    //private $bookISBN;  // 本のISBN
    private $request;   // リクエスト
    private $pathInfo;  // パス情報
    //private $resource;  // リソース
    private $data;      // データ



    function __construct()
    {

        $this->httpMethod = $_SERVER['REQUEST_METHOD'];
        //$requestURI = $_SERVER['REQUEST_URI'];
        //$uriScript = $_SERVER['SCRIPT_NAME'];

        //$this->pathInfo = $pathInfo;

        //echo "{$this->pathInfo}<br>";

        $httpUriScriptParser = new HttpURIPerser($_SERVER['REQUEST_URI']);
        $this->aUriResource = $httpUriScriptParser->getUriResource();

        //   print_r($this->aUriResource);
        //   echo "<br>";

        //$httpResourceParser = new HttpResourceParser($this->request);
        //$this->resource = $httpResourceParser->getResource();

        $httpQueryParser = new HttpQueryParser($_SERVER['QUERY_STRING']);
        $this->aQueries = $httpQueryParser->getQueries();
        //$this->resource = array_shift($this->request);

        //   print_r($this->aQueries);
        //   echo "<br>";

        switch ($this->aQueries[URI_QUERY_DATA_FORMAT]) {
            case URI_QUERY_DATA_FORMAT_JSON:
                $this->data = json_decode(file_get_contents('php://input'), true);
                break;
            case URI_QUERY_DATA_FORMAT_XML:
                $this->data = xmlrpc_decode(file_get_contents('php://input'), true);
                break;
            default:

                break;
        }
    }

    /**
     * リクエストメソッドを取得
     * @return string リクエストメソッド
     */
    function getHTTPMethod()
    {
        return $this->httpMethod;
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
    function getArrayUriResource()
    {
        return $this->aUriResource;
    }

    /**
     * IDを取得
     * @return string ID
     */
    function getBookISBN()
    {
        return $this->aQueries[URI_QUERY_ISBN];
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
