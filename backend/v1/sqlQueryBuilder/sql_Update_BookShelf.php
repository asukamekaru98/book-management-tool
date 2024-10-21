<?php

namespace SqlQueryBuilder;


require_once('SqlQueryBuilder.php');


/**
 * 書籍情報の登録を行うクラス
 */
class Sql_Update_BookShelf extends SqlQueryBuilder_BookManagementTool
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

		$purchased = $this->data['purchased'] ?? 0;
		$memo = $this->data['memo'] ?? 0;

		$this->sqlQuery = <<< "EOD"
					UPDATE books,books_shelf
					SET books.industry_important = '{$industry_important}', books.work_important = '{$work_important}', books.user_important = '{$user_important}', books.priority = '{$priority}', books_shelf.purchased = '{$purchased}', books_shelf.memo = '{$memo}'
					WHERE isbn = '{$this->isbn}'
					EOD;
	}
}
