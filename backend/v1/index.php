<?php
require_once(__DIR__ . '/constant/const_uri.php');
require_once(__DIR__ . '/http/httpManager.php');
require_once(__DIR__ . '/controller/bookshelfController.php');
require_once(__DIR__ . '/controller/wishListController.php');
require_once(__DIR__ . '/controller/readHistoriesController.php');
require_once(__DIR__ . '/rooter.php');

try {
    $db = DataBaseMySQL::connect2Database();
} catch (Exception $e) {

    ExitOfError($e->getMessage());
}


$router = new Router();
$router->addRoute(URI_BOOK_SHELF, new bookShelfController($db));
$router->addRoute(URI_WISH_LIST, new wishListController($db));
$router->addRoute(URI_READ_HIST, new readHistoriesController($db));


try {
    $httpMngr = new httpManager();
} catch (Exception $e) {
    ExitOfError($e->getMessage());
}

try {
    $router->dispatch($httpMngr);
} catch (Exception $e) {
    ExitOfError($e->getMessage());
}

$db = null; // DB接続を切断

function ExitOfError($message)
{
    http_response_code(INTERNAL_SERVER_ERROR_500);

    if (empty($message)) {
        $message = "Internal Server Error";
    }

    echo json_encode(["message" => $message]);

    $db = null;

    exit;
}
