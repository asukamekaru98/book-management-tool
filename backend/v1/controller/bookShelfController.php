<?php
require_once(__DIR__ . '/resourceController.php');

class bookShelfController extends resourceController
{

    /**
     * override
     * 
     */
    function methodGET($isbn, $data)
    {
        echo $isbn;


        if ($isbn) {
            // IDを指定した履歴の取得
            $book = $this->getBookInfo($isbn);

            if ($book) {
            } else {
            }
        } else {
            // 全履歴の取得
            $book = $this->getAllBooksInfo();
        }
    }

    /**
     * override
     * 
     */
    function methodPOST($isbn, $data)
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
    function methodPUT($isbn, $data)
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
    function methodDELETE($isbn, $data)
    {
        if ($isbn) {
            // 指定した履歴の削除
            // deletBook($isbn);
        }
    }

    function getBookInfo($isbn)
    {
        $sql = <<< "EOD"
                    SELECT books.isbn,books.title,books.sub_title,books.author,books.description,books.page,books.image_url,books.published_date,books.content,books.industry_important,books.work_important,books.user_important,books.priority,books.purchased_flag,books.viewed_flag
                    FROM books_shelf
                    LEFT JOIN books
                    ON books.id = books_shelf.book_id
                    WHERE books.isbn = '$isbn'
                    EOD;

        $sqlController = new sqlController($sql, $this->db);

        $sqlController->ShowResponse();
    }

    function getAllBooksInfo()
    {
        $sql = <<< "EOD"
                    SELECT books.isbn,books.title,books.sub_title,books.author,books.description,books.page,books.image_url,books.published_date,books.content,books.industry_important,books.work_important,books.user_important,books.priority,books.purchased_flag,books.viewed_flag
                    FROM books_shelf
                    LEFT JOIN books
                    ON books.id = books_shelf.book_id
                    EOD;

        $sqlController = new sqlController($sql, $this->db);

        $sqlController->ShowResponse();
    }
}
