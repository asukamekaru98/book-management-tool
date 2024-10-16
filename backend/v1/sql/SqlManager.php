<?php
interface I_SQLManager
{

	// SQLクエリの設定
	public function SetSqlQuery(string $sqlQuery);

	// クエリの実行
	public function ExecuteSqlQuery();

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
		protected DataBaseMySQL $db,
		protected I_ResponseBodyCreator $responseBodyCreator
	) {}

	public function SetSqlQuery(string $sqlQuery)
	{
		$this->arraySqlQuery[] = $sqlQuery;
	}

	public function ExecuteSqlQuery()
	{
		if ($this->arraySqlQuery === null || empty($this->arraySqlQuery)) {
			$this->httpResponseCode = VARIANT_ALSO_NEGOTIATES_506;
			return;
		}

		$this->arraySqlResult = [];

		foreach ($this->arraySqlQuery as $sqlQuery) {
			try {
				$stm = $this->db->prepare($sqlQuery);
				$stm->execute();
				$this->arraySqlResult = array_merge($this->arraySqlResult, $stm->fetchAll(PDO::FETCH_ASSOC));
			} catch (Exception $e) {
				$this->httpResponseCode = VARIANT_ALSO_NEGOTIATES_506;
				return;
			}

			if (empty($this->arraySqlResult)) {
				$this->httpResponseCode = NOT_FOUND_404;
				return;
			}
		}
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
