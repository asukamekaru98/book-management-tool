<?php
require_once(__DIR__ . '/resourceController.php');

class bookShelfController extends resourceController
{

    /**
     * override
     * 
     */
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
            new GetMethodResponseBodyCreator($this->format)
        );

        $sqlManager->SetSqlQuery($sqlQuery);
        $sqlManager->ExecuteSqlQuery();

        http_response_code($sqlManager->GetHttpResponseCode());
        echo $sqlManager->GetresponseBody();
    }

    /**
     * override
     * 
     */
    function methodPOST()
    {
        if ($data) {
            // 新しい本の情報を追加
            // addBook($data);
        }
    }

    /**
     * override
     * 
     */
    function methodPUT()
    {
        if ($isbn && $data) {
            // 指定した履歴の修正
            //   updateBookInfo($isbn, $data);
        }
    }

    /**
     * override
     * 
     */
    function methodDELETE()
    {
        if ($isbn) {
            // 指定した履歴の削除
            // deletBook($isbn);
        }
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
}
