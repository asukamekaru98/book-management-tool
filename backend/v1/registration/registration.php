<?php
/*
# 出荷先情報登録
function registrationCustomers($data): string
{
    $ret = NO_PROB;

    $data_cust_id = $data[RegCustId];
    $data_cust_name = $data[RegCustName];

    if (
        is_null($data_cust_id) ||
        is_null($data_cust_name)
    ) return ERR_COMM;

    // DB接続
    try {
        $db = new DataBaseMySQL();
    } catch (Exception $e) {
        error_log($e->getMessage());
        return ERR_DB_CONN;
    }

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


    $db = NULL; // DB切断

    return $ret;
}

# 出荷先情報登録
function registrationPrograms($data): string
{
    $ret = NO_PROB;

    $data_progs_ver = $data[RegProgsPgVer];
    $data_progs_filename = $data[RegProgsFileName];
    $data_progs_progdata = base64_decode($data[RegProgsPgData]);

    if (
        is_null($data_progs_ver) ||
        is_null($data_progs_filename) ||
        is_null($data_progs_progdata)
    ) return ERR_COMM;

    echo "{$data_progs_ver}\n";
    echo "{$data_progs_filename}\n";

    // $jsonFileName = 'uploads/' . $data_progs_filename;
    if (!file_put_contents($data_progs_filename, $data_progs_progdata)) {
        return ERR_COMM;
    }

    // DB接続
    try {
        $db = new DataBaseMySQL();
    } catch (Exception $e) {
        error_log($e->getMessage());
        return ERR_DB_CONN;
    }

    $datetime = date("Y-n-j G:i:s", time());

    try {
        $db->beginTransaction();

        $sqlProg = "INSERT INTO " . DB_Programs . "(" . DB_Programs_PgVer . "," . DB_Programs_FileName . "," . DB_Programs_PgData . "," . DB_Programs_CreateTime . "," . DB_Programs_UpdateTime . ") " .
            "VALUES(:prog_ver,:filename,:prog_data,:created_time,:updated_time)";

        $insertProg = $db->prepare($sqlProg);

        echo 1;
        $insertProg->execute([
            ':prog_ver' => $data_progs_ver,
            ':filename' => $data_progs_filename,
            ':prog_data' => $data_progs_progdata,
            ':created_time' => $datetime,
            ':updated_time' => $datetime
        ]);
        echo 6;
        $db->commit();
    } catch (Exception $e) {
        $db->rollBack();
        error_log($e->getMessage());

        $ret = ERR_DB_EXECUTE;
    }


    $db = NULL; // DB切断

    return $ret;
}
*/