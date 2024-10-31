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
		$this->buildSQLQuery();
	}

	public function buildSQLQuery()
	{
		// ここにSQLクエリを記述
	}

	public function getSQLQuery(): string
	{
		return $this->sqlQuery;
	}

	protected function isISBNEmpty(): bool
	{
		return empty($this->isbn);
	}
}
