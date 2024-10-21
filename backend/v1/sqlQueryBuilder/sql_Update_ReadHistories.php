<?php

namespace SqlQueryBuilder;

require_once('SqlQueryBuilder.php');


/**
 * 書籍情報の登録を行うクラス
 */
class SqlUpdateReadHistories extends SqlQueryBuilder_BookManagementTool
{
	// override
	public function BuildSQLQuery()
	{
		if ($this->IsISBNEmpty()) {
			return;
		}

		$industry_important = $this->data['industry_important'] ?? 0;
		$work_important = $this->data['work_important'] ?? 0;
		$user_important = $this->data['user_important'] ?? 0;
		$priority = $this->data['priority'] ?? 0;

		$view_start = $this->data['view-start'] ?? 0;
		$view_end = $this->data['view-end'] ?? 0;
		$impression = $this->data['impression'] ?? 0;
		$memo = $this->data['memo'] ?? 0;
		$understanding = $this->data['understanding'] ?? 0;

		$this->sqlQuery = <<< "EOD"
			UPDATE
				books
			JOIN 
				read_histories 
			ON 
				books.isbn = read_histories.isbn
			SET 
				books.industry_important = '{$industry_important}',
				books.work_important = '{$work_important}',
				books.user_important = '{$user_important}',
				books.priority = '{$priority}',
				read_histories.view_start = '{$view_start}',
				read_histories.view_end = '{$view_end}',
				read_histories.impression = '{$impression}',
				read_histories.memo = '{$memo}',
				read_histories.understanding = '{$understanding}'
			WHERE 
				books.isbn = '{$this->isbn}'
		EOD;
	}
}
