<?php
require_once(__DIR__ . '/../loader/configLoader.php');
require_once(__DIR__ . '/../constant/const_db.php');


class DataBaseMySQL extends PDO
{
    private $dbConfig;
    private $configFile;
    private $settings;
    private static $instance = null;


    // コンストラクタ
    function __construct($config = 'database.ini')
    {
        $this->configFile = $config;
        $this->initConnection();
    }

    public static function connect2Database($config = 'database.ini')
    {
        if (self::$instance === null) {
            self::$instance = new self($config);
        }
        return self::$instance;
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
        $this->dbConfig = $settings['database'];
        $port =  $this->dbConfig['port'] ?? 3306;
        $driver = $this->dbConfig['driver'] ?? 'mysql';
        $host = $this->dbConfig['host'] ?? '';
        $schema = $this->dbConfig['schema'] ?? '';
        $username = $this->dbConfig['username'] ?? NULL;
        $password = $this->dbConfig['password'] ?? NULL;

        $port = empty($port) ? '' : ";port={$port}";
        $dsn = "{$driver}:host={$host}{$port};dbname={$schema}";

        try {
            parent::__construct($dsn, $username, $password);
            $this->isDBConnValid();
            //            if (!$this->isDBConnValid()) {
            //              throw new RuntimeException("Not connected to database");
            //       }
        } catch (Exception $e) {
            throw new RuntimeException("Database Connection Error: " . $e->getMessage(), 0, $e);
        }
    }

    # DB接続の確認
    function isDBConnValid(): bool
    {
        try {
            $result = $this->query("SELECT 1");
            return $result !== false;
        } catch (Exception $e) {
            throw new RuntimeException("Database Connection Test Error: " . $e->getMessage(), 0, $e);
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
    function executeTransaction(callable $operation)
    {
        try {
            $this->beginTransaction();
            $result = $operation();
            $this->commit();
            return $result;
        } catch (Exception $e) {
            $this->rollBack();
            error_log($e->getMessage());
            return ERR_DB_EXECUTION;
        }
    }
}
