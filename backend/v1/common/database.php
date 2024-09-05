<?php
require_once(__DIR__ . '/../loader/loaders.php');
require_once(__DIR__ . '/../constant.php');


class DataBaseMySQL extends PDO
{
    private $db;
    private $configFile;

    // コンストラクタ
    function __construct($config = 'database.ini')
    {
        $this->configFile = $config;
        $this->initConnection();
    }

    // スタティックファクトリメソッド
    public static function connect2Database($config = 'database.ini')
    {
        return new self($config);
    }

    private function initConnection()
    {
        $config = $this->configFile;
        $settings = ConfigLoader::loadConfig($this->configFile);

        if (!$settings) {
            throw new RuntimeException("Error reading config:'{$config}'.");
        } else if (!array_key_exists('database', $settings)) {
            throw new RuntimeException("Invalid config:'{$config}'.");
        }

        # Database接続
        $this->db = $settings['database'];
        $port =  $this->db['port'] ?? 3306;
        $driver = $this->db['driver'] ?? 'mysql';
        $host = $this->db['host'] ?? '';
        $schema = $this->db['schema'] ?? '';
        $username = $this->db['username'] ?? NULL;
        $password = $this->db['password'] ?? NULL;

        $port = empty($port) ? '' : ";port={$port}";
        $dsn = "{$driver}:host={$host}{$port};dbname={$schema}";

        try {
            parent::__construct($dsn, $username, $password);
            $this->isDBConnValid();
            //            if (!$this->isDBConnValid()) {
            //              throw new RuntimeException("Not connected to database");
            //       }
        } catch (Exception $e) {
            throw new RuntimeException("Database Connection Error");
        }
    }

    # DB接続の確認
    function isDBConnValid(): bool
    {
        try {
            $result = $this->query("SELECT 1");
            return $result !== false;
        } catch (Exception $e) {
            throw new RuntimeException("Database Connection Test Error");
            return false;
        }
    }

    # テーブルのカラムに指定した文字列が存在するか
    # true・・・ある
    # false・・・ない
    function isStringInColumn(string $sTblName, string $sColName, string $sCheckStr): bool
    {
        $query = $this->prepare("SELECT * FROM {$sTblName} WHERE {$sColName} = :column limit 1");
        $query->execute(array(':column' => $sCheckStr));
        $result = $query->fetch();

        if ($result > 0) return true;

        return false;
    }

    # トランザクションの開始
    function executeTransaction(callable $operation): string
    {
        try {
            $this->db->beginTransaction();
            $result = $operation();
            $this->db->commit();
            return $result;
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log($e->getMessage());
            return ERR_DB_EXECUTION;
        }

        return $result;
    }
}
