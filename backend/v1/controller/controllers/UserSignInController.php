<?php
require_once(__DIR__ . '/../dataBaseController.php');

class UserSignInController extends DataBaseController
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
        return $this->toolUserSignIn($data, $this->db);
    }

    # ログイン処理
    function toolUserSignIn($data, $db): string
    {
        // トランザクション実行
        return $db->executeTransaction(function () use ($data) {



            return NO_PROB;
        });
        /*
        $ret = NO_PROB;
        $sLoginData_User = $data[UserSignInUser];
        $sLoginData_Pw = $data[UserSignInPw];

        if (
            is_null($sLoginData_User) ||
            is_null($sLoginData_Pw)
        ) return ERR_COMM;

        try {
            $db = DataBaseMySQL::connect2Database();
            echo "Database connection successful!";
        } catch (Exception $e) {
            error_log($e->getMessage());
            return ERR_DB_CONN;
        }

        try {
            $query = "SELECT * FROM " . DB_Users . " WHERE " . DB_Users_Name . " = :user";
            $stm = $db->prepare($query);

            $stm->execute([
                ':user' => $sLoginData_User,
            ]);

            $member = $stm->fetch();

            if ($member == 0) {
                // ユーザー名存在せず。
                $ret = ERR_LOGIN_NO_EXIST_USER;
            } else if (!password_verify($sLoginData_Pw, $member[DB_Users_Pw])) {
                // パスワード一致せず。
                $ret = ERR_LOGIN_PW_MISSMATCH;
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            $ret = ERR_DB_EXECUTE;
        }

        //$db = NULL; // DB切断
        return $ret;
        */
    }
}
