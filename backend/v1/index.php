<?php
require_once(__DIR__ . '/http/HttpRequestManager.php');
require_once(__DIR__ . '/controller/bookshelfController.php');

try {
    $db = DataBaseMySQL::connect2Database();
} catch (Exception $e) {

    http_response_code(500);
    echo json_encode(["message" => $e->getMessage()]);
    return;
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

/*
switch ($httpRequestManager->getResource()) {
    case 'read-histories':
        handleReadHistories($httpRequestManager->getMethod(), $httpRequestManager->getBookISBN(), $httpRequestManager->getData());
        break;
    case 'books':
        handleBooks($httpRequestManager->getMethod(), $id, $data);
        break;
    default:
        http_response_code(404);
        echo json_encode(["message" => "Resource not found"]);
        break;
}
        */
/*
function handleReadHistories($method, $isbn, $data)
{
    switch ($method) {
        case 'GET':
            if ($isbn) {
                // IDを指定した履歴の取得
                getReadHistory($isbn);
            } else {
                // 全履歴の取得
                getAllReadHistories();
            }
            break;
        case 'PUT':
            if ($isbn && $data) {
                // 指定した履歴の修正
                updateReadHistory($isbn, $data);
            }
            break;
        case 'DELETE':
            if ($isbn) {
                // 指定した履歴の削除
                deleteReadHistory($isbn);
            }
            break;
        default:
            http_response_code(405);
            echo json_encode(["message" => "Method not allowed"]);
            break;
    }
}

function handleBooks($method, $id, $data)
{
    switch ($method) {
        case 'GET':
            if ($id) {
                // IDを指定した本の情報の取得
                getBook($id);
            } else {
                // 全ての本の情報の取得
                getAllBooks();
            }
            break;
        case 'POST':
            if ($data) {
                // 新しい本の情報を追加
                addBook($data);
            }
            break;
        default:
            http_response_code(405);
            echo json_encode(["message" => "Method not allowed"]);
            break;
    }
}

// 履歴の取得関数（サンプル実装）
function getReadHistory($id)
{
    echo json_encode(["message" => "Fetching read history with ID $id"]);
}

// 全履歴の取得関数（サンプル実装）
function getAllReadHistories()
{
    echo json_encode(["message" => "Fetching all read histories"]);
}

// 履歴の修正関数（サンプル実装）
function updateReadHistory($id, $data)
{
    echo json_encode(["message" => "Updating read history with ID $id", "data" => $data]);
}

// 履歴の削除関数（サンプル実装）
function deleteReadHistory($id)
{
    echo json_encode(["message" => "Deleting read history with ID $id"]);
}

// 本の情報の取得関数（サンプル実装）
function getBook($id)
{
    echo json_encode(["message" => "Fetching book with ID $id"]);
}

// 全ての本の情報の取得関数（サンプル実装）
function getAllBooks()
{
    echo json_encode(["message" => "Fetching all books"]);
}

// 新しい本の情報を追加する関数（サンプル実装）
function addBook($data)
{
    echo json_encode(["message" => "Adding new book", "data" => $data]);
}

*/

/*
if (json_last_error() !== JSON_ERROR_NONE) {
    error_log('JSON Error: ' . json_last_error_msg());
    echo "Error";
    exit;
}
*/

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