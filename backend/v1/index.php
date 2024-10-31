<?php

use DataBase\DataBaseMySQL;
use ReturnResponse\ReturnResponse;
use ResponseCreator\ResponseCreator;
use ResponseBodyCreator\ResponseBodyCreatorFactory;
use ResponseCodeCreator\ResponseCodeCreator;

require_once __DIR__ . '/database/database.php';
require_once __DIR__ . '/controller/bookShelfController.php';
require_once __DIR__ . '/controller/wishListController.php';
require_once __DIR__ . '/controller/readHistoriesController.php';
require_once __DIR__ . '/http/httpManager.php';
require_once __DIR__ . '/rooter.php';
require_once __DIR__ . '/responseBodyCreator/responseBodyCreatorFactory.php';
require_once __DIR__ . '/responseCodeCreator/responseCodeCreator.php';
require_once __DIR__ . '/returnResponse/returnResponse.php';
require_once __DIR__ . '/responseCreator/responseCreator.php';

$bookManagementTool = new BookManagementTool();
$bookManagementTool->run();

class BookManagementTool
{
    private DataBaseMySQL $dbSQL;
    private int $httpResponseCode;
    private array $responseBody;

    public function run()
    {
        try {
            $this->dbSQL = DataBaseMySQL::connect2Database();
        } catch (Exception $e) {
            $this->CreateErrorResponseBody($e);
        }

        $router = new Router();
        $router->addRoute(URI_BOOK_SHELF, new bookShelfController($this->dbSQL));
        $router->addRoute(URI_WISH_LIST, new wishListController($this->dbSQL));
        $router->addRoute(URI_READ_HIST, new readHistoriesController($this->dbSQL));


        //ToDo: httpManagetという名前と実際の動作が乖離しているので、リネームする
        try {
            $httpMngr = new httpManager();
            $router->dispatch($httpMngr);
        } catch (Exception $e) {
            $this->CreateErrorResponseBody($e);
        }
    }



    /**
     * エラー終了
     */
    function CreateErrorResponseBody(Exception $e, string $format = 'json')
    {
        $responseCreator = new ResponseCreator(
            ResponseBodyCreatorFactory::CreateRespoonseBody_Error($format),
            new ResponseCodeCreator()
        );

        $responseCreator->CreateResponse(
            $e->getCode(),
            array('message' => $e->getMessage())
        );

        ReturnResponse::returnHttpResponse($responseCreator);
        exit;
    }

    function __destruct()
    {
        //$this->dbSQL = null; // DB接続を切断
    }
}
