<?php
interface ISQLManager
{
	const RESPONSE_BODY_TEMPLATE = [
		'bookinfo' => [
			'isbn' => '',
			'title' => '',
			'sub_title' => '',
			'author' => '',
			'description' => '',
			'image_url' => '',
			'published_date' => '',
			'content' => '',
		],
		'userinfo' => [
			'industry_important' => '',
			'work_important' => '',
			'user_important' => '',
			'priority' => '',
			'purchased_flag' => '',
			'viewed_flag' => '',
		],
	];

	private string $httpResponseCode;	// HTTPレスポンスコード
	private array $responseBody;		// HTTPレスポンスボディ
	private array $arraySqlResult;		// SQLクエリの結果
	private array $arraySqlQuery;		// SQLクエリの配列

	public function __construct(
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

class SQLManager implements ISQLManager
{

	public function __construct(
		protected DataBaseMySQL $db
	) {}

	public function SetSqlQuery(string $sqlQuery)
	{
		$this->arraySqlQuery[] = $sqlQuery;
	}

	public function ExecuteQuery()
	{
		try {
			$stm = $this->db->prepare($this->sqlQuery);
			$stm->execute();
			$this->arraySqlResult = $stm->fetchAll(PDO::FETCH_ASSOC);
			$this->CreateHttpResponse();
		} catch (Exception $e) {
			$this->httpResponseCode = VARIANT_ALSO_NEGOTIATES_506;
		}
	}

	public function GetHttpesponseCode() {}

	public function GetresponseBody() {}

	private function CreateHttpResponseJSON()
	{
		$responseArray = array_map(
			function ($row) {
				$responseBody = self::RESPONSE_BODY_TEMPLATE;
				$responseBody['bookinfo']['isbn']				= $row['isbn'];
				$responseBody['bookinfo']['title']				= $row['title'];
				$responseBody['bookinfo']['sub_title']			= $row['sub_title'];
				$responseBody['bookinfo']['author']				= $row['author'];
				$responseBody['bookinfo']['description']		= $row['description'];
				$responseBody['bookinfo']['image_url']			= $row['image_url'];
				$responseBody['bookinfo']['published_date']		= $row['published_date'];
				$responseBody['bookinfo']['content']			= $row['content'];
				$responseBody['userinfo']['industry_important']	= $row['industry_important'];
				$responseBody['userinfo']['work_important']		= $row['work_important'];
				$responseBody['userinfo']['user_important']		= $row['user_important'];
				$responseBody['userinfo']['priority']			= $row['priority'];
				$responseBody['userinfo']['purchased_flag']		= $row['purchased_flag'];
				$responseBody['userinfo']['viewed_flag']		= $row['viewed_flag'];
				return $responseBody;
			},
			$this->arraySqlResult
		);

		$this->responseArray = json_encode($responseArray);
		$this->httpResponseCode = OK_200;
	}
}
