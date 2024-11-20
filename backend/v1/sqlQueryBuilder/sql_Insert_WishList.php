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

		$memo = $this->data[DB_WISH_LISTS_MEMO] ?? 0;

		$this->sqlQuery = <<< "EOD"
                    INSERT INTO wish_list (isbn, memo)
                    VALUES ('{$this->isbn}','{$memo}')

                    EOD;
	}
}
