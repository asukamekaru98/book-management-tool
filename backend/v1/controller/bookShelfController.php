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
            $book =  getAllBooksInfo();
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
        try {
            //self::$db->beginTransaction();

            $sql = <<< "EOD"
                    SELECT books.isbn,books.title,books.sub_title,books.author,books.description,books.page,books.image_url,books.published_date,books.content,books.industry_important,books.work_important,books.user_important,books.priority,books.purchased_flag,books.viewed_flag
                    FROM books_shelf
                    LEFT JOIN books
                    ON books.id = books_shelf.book_id
                    WHERE books.isbn = '$isbn'
                    EOD;

            $stm = $this->db->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            http_response_code(VARIANT_ALSO_NEGOTIATES_506);
        }

        http_response_code(OK_200);

        $responseJSON = [
            'bookinfo' => [
                'isbn' => $result['isbn'],
                'title' => $result['title'],
                'sub_title' => $result['sub_title'],
                'author' => $result['author'],
                'description' => $result['description'],
                'image_url' => $result['image_url'],
                'published_date' => $result['published_date'],
                'content' => $result['content'],
            ],
            'userinfo' => [
                'industry_important' => $result['industry_important'],
                'work_important' => $result['work_important'],
                'user_important' => $result['user_important'],
                'priority' => $result['priority'],
                'purchased_flag' => $result['purchased_flag'],
                'viewed_flag' => $result['viewed_flag'],
            ],
        ];

        echo json_encode($result);
    }

    function getAllBooksInfo()
    {
        try {
            //self::$db->beginTransaction();

            $sql = <<< "EOD"
                    SELECT books.isbn,books.title,books.sub_title,books.author,books.description,books.page,books.image_url,books.published_date,books.content,books.industry_important,books.work_important,books.user_important,books.priority,books.purchased_flag,books.viewed_flag
                    FROM books_shelf
                    LEFT JOIN books
                    ON books.id = books_shelf.book_id
                    EOD;

            $stm = $this->db->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            http_response_code(VARIANT_ALSO_NEGOTIATES_506);
        }

        http_response_code(OK_200);

        $responseJSON = [
            'bookinfo' => [
                'isbn' => $result['isbn'],
                'title' => $result['title'],
                'sub_title' => $result['sub_title'],
                'author' => $result['author'],
                'description' => $result['description'],
                'image_url' => $result['image_url'],
                'published_date' => $result['published_date'],
                'content' => $result['content'],
            ],
            'userinfo' => [
                'industry_important' => $result['industry_important'],
                'work_important' => $result['work_important'],
                'user_important' => $result['user_important'],
                'priority' => $result['priority'],
                'purchased_flag' => $result['purchased_flag'],
                'viewed_flag' => $result['viewed_flag'],
            ],
        ];

        echo json_encode($result);
    }
}
