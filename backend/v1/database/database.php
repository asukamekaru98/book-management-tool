<?php

namespace DataBase;

use PDO;
use RuntimeException;
use Exception;
use Loader\ConfigLoader;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require_once __DIR__ . '/../interfaces/i_sqlManager.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../loader/configLoader.php';

class DataBaseMySQL extends PDO
{
    private Logger $log;
    private $dbConfig;
    private $configFile;
    private static $instance = null;


    // コンストラクタ
    function __construct($config = 'database.ini')
    {
        $this->log = new Logger(__CLASS__);
        $this->log->pushHandler(new StreamHandler(__DIR__ . '/../../log/log.log', Logger::INFO));
        $this->configFile = $config;
        $this->initConnection();
    }

    public static function connect2Database($config = 'database.ini'): DataBaseMySQL
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
            throw new RuntimeException("Error reading config:'{$config}'.", INTERNAL_SERVER_ERROR_500);
        } else if (!array_key_exists('database', $settings)) {
            throw new RuntimeException("Invalid config:'{$config}'.", INTERNAL_SERVER_ERROR_500);
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
            $this->log->info('データベースに接続します。');
            parent::__construct($dsn, $username, $password);
            $this->isDBConnValid();
        } catch (Exception $e) {
            $this->log->error('データベースに接続できませんでした。');
            throw new RuntimeException("Database Connection Error: " . $e->getMessage(), INTERNAL_SERVER_ERROR_500, $e);
        }
        $this->log->info('データベースに接続しました。');
    }

    # DB接続の確認
    function isDBConnValid(): bool
    {
        try {
            $result = $this->query("SELECT 1");
            return $result !== false;
        } catch (Exception $e) {
            throw new RuntimeException("Database Connection Test Error: " . $e->getMessage(), INTERNAL_SERVER_ERROR_500, $e);
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
