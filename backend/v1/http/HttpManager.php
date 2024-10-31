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
    private array $data = [];      // データ



    function __construct()
    {

        //$this->httpMethod = $_SERVER['REQUEST_METHOD'];
        $this->httpMethod = 'GET';

        $httpUriScriptParser = new HttpURIPerser(uri: $_SERVER['REQUEST_URI']);
        $this->aUriResource = $httpUriScriptParser->getUriResource();

        $httpQueryParser = new HttpQueryParser($_SERVER['QUERY_STRING']);
        $this->aQueries = $httpQueryParser->getQueries();

        switch ($this->aQueries[URI_QUERY_DATA_FORMAT]) {
            case URI_QUERY_DATA_FORMAT_JSON:
                $this->data = json_decode(json: file_get_contents(filename: 'php://input'), associative: true, depth: 512, flags: JSON_OBJECT_AS_ARRAY) ?? [];
                break;
            case URI_QUERY_DATA_FORMAT_XML:
                $this->data = xmlrpc_decode(file_get_contents(filename: 'php://input'), true);
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
     * すべてのリソースを配列で取得
     * @return string リソース
     */
    function getArrayUriResources()
    {
        return $this->aUriResource;
    }

    /**
     * リソースを取得
     * @return string リソース
     */
    function getUriResource(int $idx)
    {
        return $this->aUriResource[$idx];
    }


    /**
     * IDを取得
     * @return string ID
     */
    function getBookISBN()
    {
        return $this->aQueries[URI_QUERY_ISBN];
    }

    function getFormat()
    {
        return $this->aQueries[URI_QUERY_DATA_FORMAT];
    }

    function getViewedFlag()
    {
        return $this->aQueries[URI_QUERY_VIEWED_FLAG];
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
