<?php

namespace validator;

require_once(__DIR__ . '/../sql/SqlManager.php');
require_once(__DIR__ . '/../sqlQueryBuilder/SqlQueryBuilderFactory.php');

use SqlManager\SqlManager;
use SqlQueryBuilder\SqlQueryBuilderFactory;
use Exception;
use SqlQueryBuilder\SqlQueryBuilder_BookManagementTool;

class IsbnValidator
{
	protected SqlManager $sqlManager;

	public function __construct(SqlManager $sqlManager)
	{
		$this->sqlManager = $sqlManager;
	}

	public function IsIsbnCodeDuplicate(SqlQueryBuilder_BookManagementTool $sqlQuery): bool
	{
		//$isbnCountSQLQuery = SqlQueryBuilderFactory::IsIsbnCodeDuplicate($isbn, $data);

		try {
			$this->sqlManager->ExecuteSqlQuery($sqlQuery->GetSQLQuery());
		} catch (Exception $e) {
			throw new Exception($e->getMessage(), (int)$e->getCode());
		}

		$result = $this->sqlManager->GetResponseBody()[0]['count'];

		return $result > 0;
	}
}
