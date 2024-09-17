<?php
class readHistoriesController extends resourceController
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
    /*
    # 出荷先情報登録
    function customerReg($data, $db): string
    {
        $ret = NO_PROB;

        $data_cust_id = $data[CustRegId];
        $data_cust_name = $data[CustRegName];

        if (
            is_null($data_cust_id) ||
            is_null($data_cust_name)
        ) return ERR_COMM;

        // 出荷先名重複確認
        if ($db->isStringInColumn(DB_Customers, DB_Customers_Id, $data_cust_id)) {
            return ERR_REG_CUST_ID_DUPLICATE;
        }

        $datetime = date("Y-n-j G:i:s", time());

        try {
            $db->beginTransaction();

            $sqlCust = "INSERT INTO " . DB_Customers . " VALUES(:id,:name,:created_time,:updated_time)";

            $insertCust = $db->prepare($sqlCust);
            $insertCust->execute([
                ':id' => $data_cust_id,
                ':name' => $data_cust_name,
                ':created_time' => $datetime,
                ':updated_time' => $datetime,
            ]);
            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
            error_log($e->getMessage());

            $ret = ERR_DB_EXECUTE;
        }


        // $db = NULL; // DB切断

        return $ret;
    }
        */
}
