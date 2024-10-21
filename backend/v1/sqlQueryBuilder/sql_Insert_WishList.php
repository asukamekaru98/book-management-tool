<?php

namespace SqlQueryBuilder;


require_once('SqlQueryBuilder.php');


/**
 * 書籍情報の登録を行うクラス
 */
class SqlInsertWishList extends SqlQueryBuilder_BookManagementTool
{
	// override
	public function BuildSQLQuery()
	{
		if (empty($this->isbn)) {
			return;
		}

		$memo = $this->data['memo'] ?? 0;

		$this->sqlQuery = <<< "EOD"
                    INSERT INTO books_shelf (isbn, memo)
                    VALUES ('{$this->isbn}','{$memo}')
                    EOD;
	}
}
