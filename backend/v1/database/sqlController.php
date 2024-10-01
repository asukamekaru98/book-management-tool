<?php

abstract class sqlController
{
	private string $HttpResponse;
	private string $responseJSON;

	public function __construct(
		private $sql,
		protected DataBaseMySQL $db
	) {
		$this->ExecuteSQLInDb();
	}

	public function ExecuteSQLInDb()
	{
		try {
			$stm = $this->db->prepare($this->sql);
			$stm->execute();
			$result = $stm->fetchAll(PDO::FETCH_ASSOC);
		} catch (Exception $e) {
			$HttpResponse = VARIANT_ALSO_NEGOTIATES_506;
		}

		$HttpResponse = OK_200;

		$this->responseJSON = [
			'bookinfo' => [
				'isbn' => $result['isbn'],
				'title' => $result['title'],
				'sub_title' => $result['sub_title'],
				'author' => $result['author'],
				'description' => $result['description'],
				'image_url' => $result['image_url'],
				'published_date' => $result['published_date'],
				'content' => $result['content'],
			],
			'userinfo' => [
				'industry_important' => $result['industry_important'],
				'work_important' => $result['work_important'],
				'user_important' => $result['user_important'],
				'priority' => $result['priority'],
				'purchased_flag' => $result['purchased_flag'],
				'viewed_flag' => $result['viewed_flag'],
			],
		];
	}

	public function ShowResponse()
	{
		$this->ShowResponseCode();
		$this->ShowResponseJSON();
	}

	private function ShowResponseCode()
	{
		http_response_code($this->HttpResponse);
	}

	private function ShowResponseJSON()
	{
		echo json_encode($this->responseJSON);
	}

	public function GetHttpResponse()
	{
		return $this->HttpResponse;
	}
}
