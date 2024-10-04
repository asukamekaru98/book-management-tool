<?php
require_once(__DIR__ . '/../database/SqlController.php');

class SqlController
{

	private string $HttpResponse;
	private string $responseJSON;

	public function __construct(
		private SqlManager $sqlManager,
	) {
		$this->ExecuteSQLInDb();
	}

	public function ExecuteSQLInDb()
	{
		try {
			$stm = $this->sqlManager->GetDatabaseInstance()->prepare($this->sqlManager->GetSQLQuery());
			$stm->execute();
			$sqlResult = $stm->fetchAll(PDO::FETCH_ASSOC);
		} catch (Exception $e) {
			$this->HttpResponse = VARIANT_ALSO_NEGOTIATES_506;
		}

		$this->HttpResponse = OK_200;

		$this->sqlManager->makeApiResponseBody($sqlResult);
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
