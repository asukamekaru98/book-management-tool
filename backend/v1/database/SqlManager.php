<?php
interface SqlManager
{

	private string $HttpResponse;
	private string $responseJSON;

	public function __construct(
		private string $sqlQuery,
		protected DataBaseMySQL $db
	);

	public function makeApiResponseBody($sqlResult);
	public function SetSQLQuery(string $sqlQuery);
	public function GetSQLQuery(): string;
	public function GetDatabaseInstance(): DataBaseMySQL;
}

class SqlGetBookInfo implements SqlManager
{

	public function __construct(
		private string $sqlQuery,
		protected DataBaseMySQL $db
	) {}

	public function makeApiResponseBody($sqlResult)
	{

		$this->responseJSON = [
			'bookinfo' => [
				'isbn' => $sqlResult['isbn'],
				'title' => $sqlResult['title'],
				'sub_title' => $sqlResult['sub_title'],
				'author' => $sqlResult['author'],
				'description' => $sqlResult['description'],
				'image_url' => $sqlResult['image_url'],
				'published_date' => $sqlResult['published_date'],
				'content' => $sqlResult['content'],
			],
			'userinfo' => [
				'industry_important' => $sqlResult['industry_important'],
				'work_important' => $sqlResult['work_important'],
				'user_important' => $sqlResult['user_important'],
				'priority' => $sqlResult['priority'],
				'purchased_flag' => $sqlResult['purchased_flag'],
				'viewed_flag' => $sqlResult['viewed_flag'],
			],
		];
	}

	public function SetHTTPResponseCode() {}
	public function GetHTTPResponseCode() {}



	public function SetSQLQuery(string $sqlQuery)
	{
		$this->sqlQuery = $sqlQuery;
	}

	public function GetSQLQuery(): string
	{
		return $this->sqlQuery;
	}

	public function GetDatabaseInstance(): DataBaseMySQL
	{
		return $this->db;
	}
}
