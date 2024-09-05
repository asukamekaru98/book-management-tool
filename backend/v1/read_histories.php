<?php
require_once('common/database.php');
require_once('controller/controllers.php');
require_once('rooter.php');
require_once('constant.php');

$data = json_decode(file_get_contents('php://input'), true);

if (json_last_error() !== JSON_ERROR_NONE) {
    error_log('JSON Error: ' . json_last_error_msg());
    echo "Error";
    exit; // 処理を中断
}

$data['user_sign_up'] = [];
$data['user_sign_up']['user_sign_up_user'] = '田中';
$data['user_sign_up']['cuser_sign_up_pw'] = '123456';
$data['user_sign_up']['user_sign_up_dep'] = 2;

/*
$data[user_sign_in] = [];
$data[user_sign_in][UserSignInUser] = '田中';
$data[user_sign_in][UserSignInPw] = '123456';
*/
/*
$data[RegCust] = [];
$data[RegCust][RegCustId] = 'asdads';
$data[RegCust][RegCustName] = 'マツダ株式会社';
*/
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
