<?php
require_once(__DIR__ . '/../dataBaseController.php');

class UserSignUpController extends DataBaseController
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
        return $this->toolUserSignUp($data, $this->db);
    }

    # アカウント作成処理
    function toolUserSignUp($data, $db): string
    {
        // トランザクション実行
        return $db->executeTransaction(function () use ($data) {

            $data_acc_user = $data[UserSignUpUser];
            $data_acc_pw = $data[UserSignUpPw];
            $data_acc_dep = $data[UserSignUpDep];

            // ユーザ名重複確認
            if ($this->db->isStringInColumn(DB_Users, DB_Users_Name, $data_acc_user)) {
                return ERR_CREATE_ACC_USER_NAME_DUPLICATE;
            }

            // パスワードハッシュ化
            $data_acc_pw = password_hash($data_acc_pw, PASSWORD_DEFAULT);

            $datetime = date("Y-n-j G:i:s", time());

            $sqlUsers = "INSERT INTO users(name,password,department,created_time,updated_time) 
                    VALUES(:name,:password,:department,:created_time_users,:updated_time_users)";

            $sqlDep = "INSERT INTO departments (user,created_time,updated_time)
                    VALUES(:user,:created_time_dep,:updated_time_dep)";

            try {
                $insertUsers = $this->db->prepare($sqlUsers);
                $insertDep = $this->db->prepare($sqlDep);

                $insertUsers->execute([
                    ':name' => $data_acc_user,
                    ':password' => $data_acc_pw,
                    ':department' => $data_acc_dep,
                    ':created_time_users' => $datetime,
                    ':updated_time_users' => $datetime,
                ]);

                $newUserId = $this->db->lastInsertId();
                $insertDep->execute([
                    ':user' => $newUserId,
                    ':created_time_dep' => $datetime,
                    ':updated_time_dep' => $datetime,
                ]);
            } catch (Exception $e) {
                return ERR_DB_EXECUTION;
            }
            return NO_PROB;
        });

        /*$ret = NO_PROB;

        $data_acc_user = $data[UserSignUpUser];
        $data_acc_pw = $data[UserSignUpPw];
        $data_acc_dep = $data[UserSignUpDep];

        if (
            is_null($data_acc_user) ||
            is_null($data_acc_pw) ||
            is_null($data_acc_dep)
        ) return ERR_COMM;*/

        // DB接続
        /*  try {
            $db = new DataBaseMySQL();
        } catch (Exception $e) {
            return ERR_DB_CONN;
        }*/



        /*
        // ユーザ名重複確認
        if ($db->isStringInColumn(DB_Users, DB_Users_Name, $data_acc_user)) {
            return ERR_CREATE_ACC_USER_NAME_DUPLICATE;
        }

        // パスワードハッシュ化
        $data_acc_pw = password_hash($data_acc_pw, PASSWORD_DEFAULT);

        $datetime = date("Y-n-j G:i:s", time());
*/
        // $db->beginTransaction();

        /*
        try {
            $sqlUsers = "INSERT INTO users(name,password,department,created_time,updated_time) 
                    VALUES(:name,:password,:department,:created_time_users,:updated_time_users)";

            $sqlDep = "INSERT INTO departments (user,created_time,updated_time)
                    VALUES(:user,:created_time_dep,:updated_time_dep)";

            $insertUsers = $db->prepare($sqlUsers);
            $insertDep = $db->prepare($sqlDep);

            $insertUsers->execute([
                ':name' => $data_acc_user,
                ':password' => $data_acc_pw,
                ':department' => $data_acc_dep,
                ':created_time_users' => $datetime,
                ':updated_time_users' => $datetime,
            ]);

            $newUserId = $db->lastInsertId();
            $insertDep->execute([
                ':user' => $newUserId,
                ':created_time_dep' => $datetime,
                ':updated_time_dep' => $datetime,
            ]);
        } catch (Exception $e) {
            $db->rollBack();
            error_log($e->getMessage());

            $ret = ERR_DB_EXECUTION;
        }

        $db->commit();
        //$db = NULL; // DB切断
        return $ret;*/
    }
}
