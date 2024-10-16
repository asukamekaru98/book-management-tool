<?php

use SqlQueryBuilder\SqlBuilder_BookInfo;

require_once(__DIR__ . '/resourceController.php');
require_once(__DIR__ . '/../sql/responseBodyCreator.php');
require_once(__DIR__ . '/../parser/openDBUriParser.php');

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

        if ($this->isbn == null) {
            http_response_code(400);
            echo json_encode(['error' => ['code' => '400', 'message' => 'Bad Request']]);
            return;
        }




        // OpenBD APIにアクセス
        /*       $accessOpenDBAPI = new AccessOpenDBAPI();
        $accessOpenDBAPI->SetOptionQueries("isbn={$this->isbn}");
        $accessOpenDBAPI->AccessAPI();
        $openDBApiResponse = $accessOpenDBAPI->GetApiResponseBody();

        $isbn = $openDBApiResponse['isbn'] ?? '';
        $title = $openDBApiResponse['title'] ?? '';
        $sub_title = $openDBApiResponse['sub_title'] ?? '';
        $author = $openDBApiResponse['author'] ?? '';
        $description = $openDBApiResponse['description'] ?? '';
        $page = $openDBApiResponse['page'] ?? '';
        $image_url = $openDBApiResponse['image_url'] ?? '';
        $published_date = $openDBApiResponse['published_date'] ?? '';
        $content = $openDBApiResponse['content'] ?? '';


        $sqlQuery = <<< "EOD"
                    INSERT INTO books (isbn, title, sub_title, author, description, page, image_url, published_date, content, industry_important, work_important, user_important, priority, purchased_flag, viewed_flag)
                    VALUES (
                        '{$isbn}',
                        '{$title}',
                        '{$sub_title}',
                        '{$author}',
                        '{$description}',
                        '{$page}',
                        '{$image_url}',
                        '{$published_date}',
                        '{$content}',
                        '{$this->industry_important}', 
                        '{$this->work_important}', 
                        '{$this->user_important}', 
                        '{$this->priority}', 
                        '{$this->purchased_flag}',
                        '{$this->viewed_flag}')
                    EOD;

*/

        //$sqlManager->SetSqlQuery($sqlQuery);
        $sqlManager->ExecuteSqlQuery($sqlQuery);

        print($sqlManager->GetHttpResponseCode());

        //http_response_code($sqlManager->GetHttpResponseCode());
        //print_r($sqlManager->GetresponseBody());
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
