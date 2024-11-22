<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require_once('httpURIPerser.php');
require_once('HttpResourceParser.php');
require_once('HttpQueryParser.php');
require_once __DIR__ . '/../../vendor/autoload.php';

class httpManager
{
    protected Logger $log;
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
        $this->log = new Logger(__CLASS__);
        $this->log->pushHandler(new StreamHandler(__DIR__ . '/../../log/log.log', Logger::INFO));

        $this->httpMethod = $_SERVER['REQUEST_METHOD'];

        $httpUriScriptParser = new HttpURIPerser(uri: $_SERVER['REQUEST_URI']);
        $this->aUriResource = $httpUriScriptParser->getUriResource();

        $httpQueryParser = new HttpQueryParser($_SERVER['QUERY_STRING']);
        $this->aQueries = $httpQueryParser->getQueries();

        $this->log->info('リクエストを受け付けました。');
        $this->log->info('HTTPメソッド:' . $this->httpMethod);
        $this->log->info('リクエストURI:' . $_SERVER['REQUEST_URI']);

        switch ($this->aQueries[URI_QUERY_DATA_FORMAT]) {
            case URI_QUERY_DATA_FORMAT_JSON:
                $this->log->info('フォーマット:' . URI_QUERY_DATA_FORMAT_JSON);

                $input = file_get_contents('php://input');

                $this->log->info('php://input の内容: ' . $input);

                $this->data = json_decode($input, true) ?: [];

                if (json_last_error() !== JSON_ERROR_NONE) {
                    $this->log->error('JSON デコードエラー: ' . json_last_error_msg());
                }
                break;
            case URI_QUERY_DATA_FORMAT_XML:
                $this->log->info('フォーマット:' . URI_QUERY_DATA_FORMAT_XML);

                $input = file_get_contents('php://input');

                $this->log->info('php://input の内容: ' . $input);

                $this->data = xmlrpc_decode($input, true);
                break;
            default:
                $this->log->info('フォーマット:' . "不明");

                break;
        }

        //print_r($this->data);

        $this->log->info('データ: ' . json_encode($this->data) ?: "空");
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
