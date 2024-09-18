<?php
require_once(__DIR__ . '/constant/const_uri.php');
require_once(__DIR__ . '/http/HttpRequestManager.php');
require_once(__DIR__ . '/controller/bookshelfController.php');
require_once(__DIR__ . '/controller/wishListController.php');
require_once(__DIR__ . '/controller/readHistoriesController.php');
require_once(__DIR__ . '/rooter.php');

try {
    $db = DataBaseMySQL::connect2Database();
} catch (Exception $e) {

    http_response_code(INTERNAL_SERVER_ERROR_500);
    echo json_encode(["message" => $e->getMessage()]);
}


$router = new Router();
$router->addRoute(URI_BOOK_SHELF, new bookShelfController($db));
$router->addRoute(URI_WISH_LIST, new wishListController($db));
$router->addRoute(URI_READ_HIST, new readHistoriesController($db));


$httpRequestManager = new HttpRequestManager($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

$resource = $httpRequestManager->getResource();
$method = $httpRequestManager->getMethod();
$bookISBN = $httpRequestManager->getBookISBN();
$data = $httpRequestManager->getData();

$router->dispatch($resource, $method, $bookISBN, $data);

http_response_code(OK_200);
echo 'OK';

//$data['user_sign_up'] = [];
//$data['user_sign_up']['user_sign_up_user'] = '田中';
//$data['user_sign_up']['cuser_sign_up_pw'] = '123456';
//$data['user_sign_up']['user_sign_up_dep'] = 2;



//$data[user_sign_in] = [];
//$data[user_sign_in][UserSignInUser] = '田中';
//$data[user_sign_in][UserSignInPw] = '123456';


//$data[RegCust] = [];
//$data[RegCust][RegCustId] = 'asdads';
//$data[RegCust][RegCustName] = 'マツダ株式会社';
/*
$response = [];

try {
    $db = DataBaseMySQL::connect2Database();
    echo "Database connection successful!";
} catch (Exception $e) {
    //DB接続失敗
    error_log($e->getMessage());
    $response = ERR_DB_CONN;

    // JSON形式でレスポンスを返す
    header('Content-Type: application/json');
    echo json_encode($response);
    $db = null;
    exit;
}

$router = new Router();
$router->addRoute(UserSignIn, new UserSignInController($db));
$router->addRoute(UserSignUp, new UserSignUpController($db));
$router->addRoute(CustReg, new CustomerRegistrationController($db));
$router->addRoute(ProgReg, new ProgramRegistrationController($db));

$response = $router->dispatch($data);
echo json_encode($response);
$db = null;
*/