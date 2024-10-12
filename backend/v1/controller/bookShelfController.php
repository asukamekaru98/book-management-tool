<?php
require_once(__DIR__ . '/resourceController.php');

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
        echo $sqlManager->GetresponseBody();
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
        require_once(__DIR__ . '../api/openDBAPIManager.php');

        if ($this->isbn == null) {
            http_response_code(400);
            echo json_encode(['error' => ['code' => '400', 'message' => 'Bad Request']]);
            return;
        }

        $sqlManager = new SqlManager(
            $this->db,
            new GetResponseBodyGenerator($this->format)
        );

        $uriParser = new openDBUriParser($sqlManager->GetResponseBodyTemplate());

        $openDBAPIManager = new OpenDBApiManager($uriParser);
        $openDBAPIManager->SetOptionQueries('isbn', $this->isbn);
        $openDBAPIManager->AccessAPI();

        $data = $uriParser->GetData();
        $sqlQuery = <<< "EOD"
                    INSERT INTO books (isbn, title, sub_title, author, description, page, image_url, published_date, content, industry_important, work_important, user_important, priority, purchased_flag, viewed_flag)
                    VALUES (
                        '{$data['isbn']}', 
                        '{$data['title']}', 
                        '{$data['sub_title']}', 
                        '{$data['author']}', 
                        '{$data['description']}', 
                        '{$data['page']}', 
                        '{$data['image_url']}', 
                        '{$data['published_date']}', 
                        '{$data['content']}', 
                        '{$data['industry_important']}', 
                        '{$this->industry_important}', 
                        '{$this->work_important}', 
                        '{$this->user_important}', 
                        '{$this->priority}', 
                        '{$this->purchased_flag}',)
                    EOD;


        $sqlManager->SetSqlQuery($sqlQuery);
        $sqlManager->ExecuteSqlQuery();

        http_response_code($sqlManager->GetHttpResponseCode());
        echo $sqlManager->GetresponseBody();
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
        echo $sqlManager->GetresponseBody();
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
        echo $sqlManager->GetresponseBody();
    }
}
