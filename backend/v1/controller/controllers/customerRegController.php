<?php
require_once(__DIR__ . '/../dataBaseController.php');

class CustomerRegistrationController extends DataBaseController
{
    /*
    private $db;

    public function __construct(DataBaseMySQL $db)
    {
        $this->db = $db;
    }*/

    public function handle($data)
    {
        // データベース接続を利用したアカウント作成処理
        return $this->customerReg($data, $this->db);
    }

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

        // DB接続
        /* try {
            $db = new DataBaseMySQL();
        } catch (Exception $e) {
            error_log($e->getMessage());
            return ERR_DB_CONN;
        }*/

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
}
