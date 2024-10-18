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
    public function run()
    {
        try {
            $db = DataBaseMySQL::connect2Database();
        } catch (Exception $e) {
            $this->ExitOfError($e);
        }


        $router = new Router();
        $router->addRoute(URI_BOOK_SHELF, new bookShelfController($db));
        $router->addRoute(URI_WISH_LIST, new wishListController($db));
        $router->addRoute(URI_READ_HIST, new readHistoriesController($db));

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

        $db = null; // DB接続を切断

    }

    /**
     * エラー終了
     */
    function ExitOfError(Exception $e, string $format = 'json')
    {
        http_response_code($e->getCode());

        $responseBodyCreator = ResponseBodyCreatorFactory::CreateRespoonseBody($format);

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
}
