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


        if ($isbn) {
            // IDを指定した履歴の取得
            //getBookInfo($isbn);
        } else {
            // 全履歴の取得
            // getAllBooksInfo();
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
}
