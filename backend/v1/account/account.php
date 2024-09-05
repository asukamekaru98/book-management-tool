<?php
/*
require_once(__DIR__ . '/../common/database.php');
require_once(__DIR__ . '/../constant.php');

# アカウント作成処理
function createAccount($data): string
{
    $ret = NO_PROB;

    $data_acc_user = $data[CreateAccUser];
    $data_acc_pw = $data[CreateAccPw];
    $data_acc_dep = $data[CreateAccDep];

    if (
        is_null($data_acc_user) ||
        is_null($data_acc_pw) ||
        is_null($data_acc_dep)
    ) return ERR_COMM;

    // DB接続
    try {
        $db = new DataBaseMySQL();
    } catch (Exception $e) {
        return ERR_DB_CONN;
    }

    // ユーザ名重複確認
    if ($db->isStringInColumn(DB_Users, DB_Users_Name, $data_acc_user)) {
        return ERR_CREATE_ACC_USER_NAME_DUPLICATE;
    }

    // パスワードハッシュ化
    $data_acc_pw = password_hash($data_acc_pw, PASSWORD_DEFAULT);

    $datetime = date("Y-n-j G:i:s", time());

    $db->beginTransaction();

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

        $ret = ERR_DB_EXECUTE;
    }

    $db->commit();
    $db = NULL; // DB切断
    return $ret;
}

# ログイン処理
function toolLogin($data): string
{
    $ret = NO_PROB;
    $sLoginData_User = $data[LoginDataUser];
    $sLoginData_Pw = $data[LoginDataPw];

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

    $db = NULL; // DB切断
    return $ret;
}
*/