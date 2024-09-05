<?php
require_once(__DIR__ . '/../dataBaseController.php');

class ProgramRegistrationController extends DataBaseController
{
    //private $db;

    /*  public function __construct(DataBaseMySQL $db)
    {
        $this->db = $db;
    }
*/
    public function handle($data)
    {
        // データベース接続を利用したアカウント作成処理
        return $this->programRegistration($data, $this->db);
    }

    # 出荷先情報登録
    function programRegistration($data, $db): string
    {
        $ret = NO_PROB;

        $data_progs_ver = $data[ProgRegPgVer];
        $data_progs_filename = $data[ProgRegFileName];
        $data_progs_progdata = base64_decode($data[ProgRegPgData]);

        if (
            is_null($data_progs_ver) ||
            is_null($data_progs_filename) ||
            is_null($data_progs_progdata)
        ) return ERR_COMM;

        // $jsonFileName = 'uploads/' . $data_progs_filename;
        if (!file_put_contents($data_progs_filename, $data_progs_progdata)) {
            return ERR_COMM;
        }

        // DB接続
        /*
        try {
            $db = new DataBaseMySQL();
        } catch (Exception $e) {
            error_log($e->getMessage());
            return ERR_DB_CONN;
        }*/

        $datetime = date("Y-n-j G:i:s", time());

        try {
            $db->beginTransaction();

            $sqlProg = "INSERT INTO " . DB_Programs . "(" . DB_Programs_PgVer . "," . DB_Programs_FileName . "," . DB_Programs_PgData . "," . DB_Programs_CreateTime . "," . DB_Programs_UpdateTime . ") " .
                "VALUES(:prog_ver,:filename,:prog_data,:created_time,:updated_time)";

            $insertProg = $db->prepare($sqlProg);

            $insertProg->execute([
                ':prog_ver' => $data_progs_ver,
                ':filename' => $data_progs_filename,
                ':prog_data' => $data_progs_progdata,
                ':created_time' => $datetime,
                ':updated_time' => $datetime
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
