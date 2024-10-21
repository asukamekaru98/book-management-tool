<?php

namespace SqlQueryBuilder;

use Interfaces\I_SqlQueryBuilder;


require_once __DIR__ . '/../interfaces/i_sqlBuilder.php';


/**
 * 書籍情報の登録を行うクラスのテンプレート
 */
class SqlQueryBuilder_BookManagementTool implements I_SqlQueryBuilder
{
	protected string $sqlQuery = '';

	public function __construct(
		protected string $isbn,
		protected array $data
	) {
		$this->BuildSQLQuery();
	}

	public function BuildSQLQuery()
	{
		// ここにSQLクエリを記述
	}

	public function GetSQLQuery(): string
	{
		return $this->sqlQuery;
	}

	protected function IsISBNEmpty(): bool
	{
		return empty($this->isbn);
	}
}
