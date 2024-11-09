<?php

namespace SqlQueryBuilder;


require_once('SqlQueryBuilder.php');


/**
 * 書籍情報の登録を行うクラス
 */
class SqlInsertReadHistories extends SqlQueryBuilder_BookManagementTool
{
	// override
	public function BuildSQLQuery()
	{
		if (empty($this->isbn)) {
			return;
		}

		$view_start = $this->data['view-start'] ?? 0;
		$view_end = $this->data['view-end'] ?? 0;
		$impression = $this->data['impression'] ?? 0;
		$memo = $this->data['memo'] ?? 0;
		$understanding = $this->data['understanding'] ?? 0;

		$this->sqlQuery = <<< "EOD"
                    INSERT INTO books_shelf (isbn, view_start, 	view_end, impression, memo, understanding)
                    VALUES ('{$this->isbn}','{$view_start}','{$view_end}','{$impression}','{$memo}','{$understanding}')
                    EOD;
	}
}
