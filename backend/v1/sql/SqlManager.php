<?php

namespace SqlManager;

use Interfaces\I_SQLManager;
use DataBase\DataBaseMySQL;
use PDO;
use Exception;

require_once __DIR__ . '/../interfaces/i_sqlManager.php';

class SQLManager implements I_SQLManager
{
	private string $httpResponseCode;	// HTTPレスポンスコード
	private array $arraySqlResult;		// SQLクエリの結果

	public function __construct(
		protected PDO $db
	) {}


	public function ExecuteSqlQuery(string $sqlQuery, array $params = [])
	{
		if (empty($sqlQuery)) {
			$this->httpResponseCode = VARIANT_ALSO_NEGOTIATES_506;
			return;
		}

		try {
			$stmt = $this->db->prepare($sqlQuery);
			$stmt->execute($params);
			$this->arraySqlResult = $stmt->fetchAll(DataBaseMySQL::FETCH_ASSOC);
		} catch (Exception $e) {
			throw new Exception($e->getMessage(), $e->getCode());
			return;
		}


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
