<?php
interface SqlManager
{
	private string $sqlQuery;
	private string $HttpResponse;
	private string $responseJSON;

	public function __construct(
		private $sql,
		protected DataBaseMySQL $db
	);

	public function SetSQLQuery(string $sqlQuery);
	public function GetSQLQuery(): string;
	public function GetDatabaseInstance(): DataBaseMySQL;
}

class SqlGetBookInfo implements SqlManager
{

	public function __construct(
		private $sql,
		protected DataBaseMySQL $db
	) {}

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
