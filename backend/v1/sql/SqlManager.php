<?php
interface I_SQLManager
{

	const GET_RESPONSE_BODY_TEMPLATE = [
		'bookinfo' => [
			DB_BOOKS_ISBN => '',
			DB_BOOKS_TITLE => '',
			DB_BOOKS_SUB_TITLE => '',
			DB_BOOKS_AUTHOR => '',
			DB_BOOKS_DESCRIPTION => '',
			DB_BOOKS_IMAGE_URL => '',
			DB_BOOKS_PUBLISHED_DATE => '',
			DB_BOOKS_CONTENT => '',
		],
		'userinfo' => [
			DB_BOOKS_INDUSTORY_IMPORTANT => '',
			DB_BOOKS_WORK_IMPORTANT => '',
			DB_BOOKS_USER_IMPORTANT => '',
			DB_BOOKS_PRIORITY => '',
			DB_BOOKS_PURCHASED_FLAG => '',
			DB_BOOKS_VIEWED_FLAG => '',
		],
	];

	const SET_RESPONSE_BODY_TEMPLATE = [
		'message' => '',
	];

	const ERROR_RESPONSE_BODY_TEMPLATE = [
		'error' => [
			'code' => '',
			'message' => '',
		],
	];

	private string $httpResponseCode;	// HTTPレスポンスコード
	private array $responseBody;		// HTTPレスポンスボディ
	private array $arraySqlResult;		// SQLクエリの結果
	private array $arraySqlQuery;		// SQLクエリの配列

	public function __construct(
		protected DataBaseMySQL $db,
		protected I_ResponseBodyCreator $responseBodyCreator
	);

	// SQLクエリの設定
	public function SetSqlQuery(string $sqlQuery);

	// クエリの実行
	public function ExecuteSqlQuery();

	// HTTPレスポンスコードの取得
	public function GetHttpResponseCode();

	// HTTPレスポンスボディの取得
	public function GetresponseBody();
}

class SQLManager implements I_SQLManager
{

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

			try {
				$this->responseBodyCreator->CreateResponseBody($this->arraySqlResult);
			} catch (Exception $e) {
				$this->httpResponseCode = $e->getCode();
				return;
			}
		}
	}



	public final function GetHttpResponseCode()
	{
		return $this->httpResponseCode;
	}

	public final function GetresponseBody()
	{
		return $this->responseBodyCreator->GetResponseBody();
	}

	public final function GetResponseBodyTemplate()
	{
		return self::GET_RESPONSE_BODY_TEMPLATE;
	}

	public function __destruct()
	{
		$this->db = null;
	}
}
