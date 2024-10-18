<?php

use SqlQueryBuilder\SqlQueryBuilderFactory;
use ReturnResponse\ReturnResponse;
use ResponseCreator\ResponseCreator;
use ResponseBodyCreator\ResponseBodyCreatorFactory;

require_once(__DIR__ . '/resourceController.php');
require_once(__DIR__ . '/../sql/sqlManager.php');
require_once(__DIR__ . '/../sqlQueryBuilder/sqlQueryBuilderFactory.php');
require_once __DIR__ . '/../returnResponse/returnResponse.php';
require_once __DIR__ . '/../responseCreator/responseCreator.php';
require_once __DIR__ . '/../responseCreator/responseBodyCreator/responseBodyCreator.php';
require_once __DIR__ . '/../responseCreator/responseBodyCreator/responseBodyCreatorFactory.php';

class bookShelfController extends resourceController
{

    // override
    function methodGET()
    {

        if ($this->isbn) {
            // IDを指定した履歴の取得
            $sqlQuery = $this->getBookInfoSqlQuery();
        } else {
            // 全履歴の取得
            $sqlQuery = $this->getAllBooksInfo();
        }

        $sqlManager = new SqlManager(
            $this->db,
            new GetResponseBodyGenerator($this->format)
        );

        $sqlManager->SetSqlQuery($sqlQuery);
        $sqlManager->ExecuteSqlQuery();

        http_response_code($sqlManager->GetHttpResponseCode());
        //  print_r($sqlManager->GetresponseBody());
    }

    private function getBookInfoSqlQuery(): string
    {
        $isbn = $this->isbn;

        $sqlQuery = <<< "EOD"
                    SELECT books.isbn,books.title,books.sub_title,books.author,books.description,books.page,books.image_url,books.published_date,books.content,books.industry_important,books.work_important,books.user_important,books.priority,books.purchased_flag,books.viewed_flag
                    FROM books_shelf
                    LEFT JOIN books
                    ON books.id = books_shelf.book_id
                    WHERE books.isbn = '$isbn'
                    EOD;

        return $sqlQuery;
    }

    private function getAllBooksInfo(): string
    {
        $sqlQuery = <<< "EOD"
                    SELECT books.isbn,books.title,books.sub_title,books.author,books.description,books.page,books.image_url,books.published_date,books.content,books.industry_important,books.work_important,books.user_important,books.priority,books.purchased_flag,books.viewed_flag
                    FROM books_shelf
                    LEFT JOIN books
                    ON books.id = books_shelf.book_id
                    EOD;

        return $sqlQuery;
    }

    // override
    function methodPOST()
    {

        require_once(__DIR__ . '/../api/accessOpenDBAPI.php');

        if ($this->IsISBNCodeNotSet()) {
            // ISBNコードが設定されていない場合、エラーを返す
            throw new Exception("ISBN code is not set", PRECONDITION_REQUIRED_428);
        }

        // SQLクエリの生成
        $bookShelfSQLQueryBuilder = SqlQueryBuilderFactory::InsertBookShelf(
            $this->isbn,
            $this->data
        );

        // SQLクエリの実行
        $this->sqlManager->ExecuteSqlQuery($bookShelfSQLQueryBuilder->GetSQLQuery());

        // SQLクエリの実行結果を確認
        if ($this->sqlManager->GetHttpResponseCode() == 200) {
            http_response_code(200);
            echo json_encode(['message' => 'Book successfully added to the shelf']);
        } else {
            http_response_code($this->sqlManager->GetHttpResponseCode());
            echo json_encode(['message' => 'Failed to add book to the shelf']);
        }


        $responseCreator = new ResponseCreator(
            ResponseBodyCreatorFactory::CreateRespoonseBody($this->format)
        );

        ReturnResponse::returnHttpResponse($responseCreator);
    }

    // override
    function methodPUT()
    {
        if ($this->isbn == null) {
            http_response_code(400);
            echo json_encode(['error' => ['code' => '400', 'message' => 'Bad Request']]);
            return;
        }

        $sqlQuery = <<< "EOD"
                    UPDATE books_shelf
                    SET industry_important = '{$this->industry_important}', work_important = '{$this->work_important}', user_important = '{$this->user_important}', priority = '{$this->priority}', purchased_flag = '{$this->purchased_flag}', viewed_flag = '{$this->viewed_flag}'
                    WHERE isbn = '{$this->isbn}'
                    EOD;

        $sqlManager = new SqlManager(
            $this->db,
            new GetResponseBodyGenerator($this->format)
        );

        $sqlManager->SetSqlQuery($sqlQuery);
        $sqlManager->ExecuteSqlQuery();

        http_response_code($sqlManager->GetHttpResponseCode());
        // print_r($sqlManager->GetresponseBody());
    }

    // override
    function methodDELETE()
    {
        $sqlQuery = <<< "EOD"
                    DELETE FROM books_shelf
                    WHERE isbn = '{$this->isbn}'
                    EOD;

        $sqlManager = new SqlManager(
            $this->db,
            new GetResponseBodyGenerator($this->format)
        );

        $sqlManager->SetSqlQuery($sqlQuery);
        $sqlManager->ExecuteSqlQuery();

        http_response_code($sqlManager->GetHttpResponseCode());
        //print_r($sqlManager->GetresponseBody());
    }

    private function ResponseBody($message)
    {
        http_response_code(INTERNAL_SERVER_ERROR_500);

        if (empty($message)) {
            $message = "Internal Server Error";
        }

        echo json_encode(["message" => $message]);

        $db = null;

        exit;
    }
}
