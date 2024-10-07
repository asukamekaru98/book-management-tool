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
		protected String $HttpResponseFormat,
		protected DataBaseMySQL $db
	);

	// SQLクエリの設定
	public function SetSqlQuery(string $sqlQuery);

	// クエリの実行
	public function ExecuteQuery();

	// HTTPレスポンスコードの取得
	public function GetHttpesponseCode();

	// HTTPレスポンスボディの取得
	public function GetresponseBody();
}

class SQLManager implements I_SQLManager
{

	public function __construct(
		protected String $HttpResponseFormat,
		protected DataBaseMySQL $db,
		protected I_ResponseBodyCreator $responseBodyCreator
	) {}

	public function SetSqlQuery(string $sqlQuery)
	{
		$this->arraySqlQuery[] = $sqlQuery;
	}

	public function ExecuteQuery()
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
		}

		if (empty($this->arraySqlResult)) {
			$this->httpResponseCode = NOT_FOUND_404;
			return;
		}

		if ($this->HttpResponseFormat === URI_QUERY_DATA_FORMAT_JSON) {
			$this->CreateHttpResponseJSON();
		} else {
			$this->httpResponseCode = NOT_ACCEPTABLE_406;
		}

		$this->CreateHttpResponseJSON();
	}

	private function CreateHttpResponseJSON()
	{
		$responseArray = array_map(
			function ($row) {
				$responseBody = self::GET_RESPONSE_BODY_TEMPLATE;
				$responseBody['bookinfo'][DB_BOOKS_ISBN]				= $row[DB_BOOKS_ISBN];
				$responseBody['bookinfo'][DB_BOOKS_TITLE]				= $row[DB_BOOKS_TITLE];
				$responseBody['bookinfo'][DB_BOOKS_SUB_TITLE]			= $row[DB_BOOKS_SUB_TITLE];
				$responseBody['bookinfo'][DB_BOOKS_AUTHOR]				= $row[DB_BOOKS_AUTHOR];
				$responseBody['bookinfo'][DB_BOOKS_DESCRIPTION]			= $row[DB_BOOKS_DESCRIPTION];
				$responseBody['bookinfo'][DB_BOOKS_IMAGE_URL]			= $row[DB_BOOKS_IMAGE_URL];
				$responseBody['bookinfo'][DB_BOOKS_PUBLISHED_DATE]		= $row[DB_BOOKS_PUBLISHED_DATE];
				$responseBody['bookinfo'][DB_BOOKS_CONTENT]				= $row[DB_BOOKS_CONTENT];
				$responseBody['userinfo'][DB_BOOKS_INDUSTORY_IMPORTANT]	= $row[DB_BOOKS_INDUSTORY_IMPORTANT];
				$responseBody['userinfo'][DB_BOOKS_WORK_IMPORTANT]		= $row[DB_BOOKS_WORK_IMPORTANT];
				$responseBody['userinfo'][DB_BOOKS_USER_IMPORTANT]		= $row[DB_BOOKS_USER_IMPORTANT];
				$responseBody['userinfo'][DB_BOOKS_PRIORITY]			= $row[DB_BOOKS_PRIORITY];
				$responseBody['userinfo'][DB_BOOKS_PURCHASED_FLAG]		= $row[DB_BOOKS_PURCHASED_FLAG];
				$responseBody['userinfo'][DB_BOOKS_VIEWED_FLAG]			= $row[DB_BOOKS_VIEWED_FLAG];
				return $responseBody;
			},
			$this->arraySqlResult
		);


		$responseBody = json_encode($responseArray);
		if ($responseBody === false || $responseBody === null) {
			$this->httpResponseCode = INTERNAL_SERVER_ERROR_500;
			return;
		}

		$this->responseBody = $responseBody;
		$this->httpResponseCode = OK_200;
	}



	public function GetHttpesponseCode()
	{
		return $this->httpResponseCode;
	}

	public function GetresponseBody()
	{
		return $this->responseBody;
	}
}
