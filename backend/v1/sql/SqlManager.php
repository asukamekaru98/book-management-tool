<?php

namespace SqlManager;

use Interfaces\I_SQLManager;
use DataBase\DataBaseMySQL;
use PDO;
use Exception;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

require_once __DIR__ . '/../interfaces/i_sqlManager.php';
require_once __DIR__ . '/../../vendor/autoload.php';

class SQLManager implements I_SQLManager
{
	private Logger $log;
	private string $httpResponseCode;	// HTTPレスポンスコード
	private array $arraySqlResult;		// SQLクエリの結果

	public function __construct(
		protected PDO $db
	) {
		$this->log = new Logger(__CLASS__);
		$this->log->pushHandler(new StreamHandler(__DIR__ . '/../../log/log.log', Logger::INFO));
	}


	public function ExecuteSqlQuery(string $sqlQuery, array $params = [])
	{
		if (empty($sqlQuery)) {
			$this->httpResponseCode = VARIANT_ALSO_NEGOTIATES_506;
			$this->log->error('SQLクエリが空です。');

			return;
		}

		$this->log->log(Logger::INFO, 'SQLクエリを実行します。' . $sqlQuery);

		try {
			$stmt = $this->db->prepare($sqlQuery);
			$stmt->execute($params);
			$this->arraySqlResult = $stmt->fetchAll(DataBaseMySQL::FETCH_ASSOC);
		} catch (Exception $e) {
			$this->log->error('SQLクエリの実行に失敗しました。');

			throw new Exception($e->getMessage(), (int)$e->getCode());
		}

		$this->log->log(Logger::INFO, 'SQLクエリの実行が完了しました。');

		$this->httpResponseCode = OK_200;
	}



	public final function GetHttpResponseCode(): int
	{
		return $this->httpResponseCode;
	}

	public function GetResponseBody(): array
	{
		return $this->arraySqlResult;
	}
}
