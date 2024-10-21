<?php

namespace SqlQueryBuilder;


require_once('SqlQueryBuilder.php');


/**
 * 書籍情報の登録を行うクラス
 */
class Sql_Insert_BookShelf extends SqlQueryBuilder_BookManagementTool
{
	// override
	public function BuildSQLQuery()
	{
		if (empty($this->isbn)) {
			return;
		}

		$purchased = $this->data['purchased'] ?? 0;
		$memo = $this->data['memo'] ?? 0;

		$this->sqlQuery = <<< "EOD"
                    INSERT INTO books_shelf (isbn, purchased, memo)
                    VALUES ('{$this->isbn}','{$purchased}','{$memo}')
                    EOD;
	}
}
