<?php

use DataBase\DataBaseMySQL;
use ResponseBodyCreator\ResponseBodyCreatorFactory;

require_once __DIR__ . '/database/database.php';
require_once __DIR__ . '/controller/bookShelfController.php';
require_once __DIR__ . '/controller/wishListController.php';
require_once __DIR__ . '/controller/readHistoriesController.php';
require_once __DIR__ . '/http/httpManager.php';
require_once __DIR__ . '/rooter.php';
require_once __DIR__ . '/responseBodyCreator/responseBodyCreatorFactory.php';


$bookManagementTool = new BookManagementTool();
$bookManagementTool->run();

class BookManagementTool
{
    private DataBaseMySQL $dbSQL;

    public function run()
    {
        try {
            $this->dbSQL = DataBaseMySQL::connect2Database();
        } catch (Exception $e) {
            $this->ExitOfError($e);
        }


        $router = new Router();
        $router->addRoute(URI_BOOK_SHELF, new bookShelfController($this->dbSQL));
        $router->addRoute(URI_WISH_LIST, new wishListController($this->dbSQL));
        $router->addRoute(URI_READ_HIST, new readHistoriesController($this->dbSQL));

        //ToDo: httpManagetという名前と実際の動作が乖離しているので、リネームする

        try {
            $httpMngr = new httpManager();
        } catch (Exception $e) {
            $this->ExitOfError($e);
        }

        try {
            $router->dispatch($httpMngr);
        } catch (Exception $e) {
            $this->ExitOfError($e);
        }
    }

    /**
     * エラー終了
     */
    function ExitOfError(Exception $e, string $format = 'json')
    {
        http_response_code($e->getCode());

        $responseBodyCreator = ResponseBodyCreatorFactory::CreateRespoonseBody($format);

        http_response_code($e->getCode());
        echo  $responseBodyCreator->CreateErrorResponseBody(["message" => $e->getMessage()]);

        exit;
    }

    /**
     * 正常終了
     */
    function ExitOfCorrect(Exception $e)
    {
        http_response_code(OK_200);

        if (empty($message)) {
            $message = "Correct";
        }

        echo json_encode(["message" => $message]);

        $db = null;

        exit;
    }

    function __destruct()
    {
        $this->dbSQL = null; // DB接続を切断
    }
}
