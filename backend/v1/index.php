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


$httpMngr = new httpManager();

$resource = $httpMngr->getUriResource(1);
$method = $httpMngr->getHTTPMethod();
$bookISBN = $httpMngr->getBookISBN();
$data = $httpMngr->getData();

print_r($resource);
echo "<br>";
echo "{$method}<br>";
echo "{$bookISBN}<br>";
echo "{$data}<br>";

try {
    $router->dispatch($resource, $method, $bookISBN, $data);
} catch (Exception $e) {
    echo json_encode(["message" => $e->getMessage()]);
    exit;
}


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