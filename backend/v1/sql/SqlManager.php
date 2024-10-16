<?php

use Interfaces\I_SqlQueryBuilder;

interface I_SQLManager
{

	// SQLクエリの設定
	//public function SetSqlQuery(string $sqlQuery);

	// クエリの実行
	public function ExecuteSqlQuery(I_SqlQueryBuilder $sqlQueryBuilder);

	// HTTPレスポンスコードの取得
	public function GetHttpResponseCode();

	// HTTPレスポンスボディの取得
	//public function GetResponseBody(): array;
}

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

	public function ExecuteSqlQuery(I_SqlQueryBuilder $sqlQueryBuilder)
	{
		//if ($this->arraySqlQuery === null || empty($this->arraySqlQuery)) {
		if ($sqlQueryBuilder === null) {
			$this->httpResponseCode = VARIANT_ALSO_NEGOTIATES_506;
			return;
		}

		$sqlQuery = $sqlQueryBuilder->GetSQLQuery();


		$this->arraySqlResult = [];

		//foreach ($this->arraySqlQuery as $sqlQuery) {
		try {
			$stm = $this->db->prepare($sqlQuery);
			$stm->execute();
			//$this->arraySqlResult = array_merge($this->arraySqlResult, $stm->fetchAll(PDO::FETCH_ASSOC));
		} catch (Exception $e) {
			echo $e->getMessage();
			$this->httpResponseCode = VARIANT_ALSO_NEGOTIATES_506;
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

	//public final function GetResponseBody(): array
	//{
	//return $this->responseBodyCreator->GetResponseBody();
	//}

	public final function GetResponseBodyTemplate()
	{
		//return self::GET_RESPONSE_BODY_TEMPLATE;
	}
}
