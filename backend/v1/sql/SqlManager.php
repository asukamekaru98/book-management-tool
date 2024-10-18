<?php

namespace SqlManager;

use Interfaces\I_SQLManager;
use DataBase\DataBaseMySQL;

require_once __DIR__ . '/../interfaces/i_sqlManager.php';

class SQLManager implements I_SQLManager
{
	private string $httpResponseCode;	// HTTPレスポンスコード
	private array $responseBody;		// HTTPレスポンスボディ
	private array $arraySqlResult;		// SQLクエリの結果
	private array $arraySqlQuery;		// SQLクエリの配列

	public function __construct(
		protected DataBaseMySQL $db
	) {}

	//public function SetSqlQuery(string $sqlQuery)
	//{
	//	$this->arraySqlQuery[] = $sqlQuery;
	//}

	public function ExecuteSqlQuery(string $sqlQuery)
	{
		//if ($this->arraySqlQuery === null || empty($this->arraySqlQuery)) {
		if ($sqlQuery === null) {
			$this->httpResponseCode = VARIANT_ALSO_NEGOTIATES_506;
			return;
		}

		//foreach ($this->arraySqlQuery as $sqlQuery) {
		try {
			$stm = $this->db->prepare($sqlQuery);
			$stm->execute();
			$this->arraySqlResult = $stm->fetchAll(DataBaseMySQL::FETCH_ASSOC);
			//$this->arraySqlResult = array_merge($this->arraySqlResult, $stm->fetchAll(PDO::FETCH_ASSOC));
		} catch (\Exception $e) {
			throw new \Exception($e->getMessage(), $e->getCode());
			return;
		}

		//if (empty($this->arraySqlResult)) {
		//	$this->httpResponseCode = NOT_FOUND_404;
		//	return;
		//}
		//}

		$this->httpResponseCode = OK_200;
	}



	public final function GetHttpResponseCode()
	{
		return $this->httpResponseCode;
	}

	public final function GetSqlResult()
	{
		return $this->arraySqlResult;
	}
}
