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

    http_response_code(INTERNAL_SERVER_ERROR_500);
    echo json_encode(["message" => $e->getMessage()]);
    exit;
}


$router = new Router();
$router->addRoute(URI_BOOK_SHELF, new bookShelfController($db));
$router->addRoute(URI_WISH_LIST, new wishListController($db));
$router->addRoute(URI_READ_HIST, new readHistoriesController($db));


try {
    $httpMngr = new httpManager();
} catch (Exception $e) {
    echo json_encode(["message" => $e->getMessage()]);
    exit();
}

print_r($resource);
echo "<br>";
echo "{$method}<br>";
echo "{$bookISBN}<br>";
echo "{$data}<br>";

try {
    $router->dispatch($httpMngr);
} catch (Exception $e) {
    echo json_encode(["message" => $e->getMessage()]);
    exit();
}
