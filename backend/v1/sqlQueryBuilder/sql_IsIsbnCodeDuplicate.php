<?php

namespace SqlQueryBuilder;

require_once('SqlQueryBuilder.php');

/**
 * 書籍情報の登録を行うクラス
 */
class Sql_IsIsbnCodeDuplicate extends SqlQueryBuilder_BookManagementTool
{
	// override
	public function BuildSQLQuery()
	{
		if (empty($this->isbn)) {
			return;
		}

		$this->sqlQuery = <<< "EOD"
                    SELECT COUNT(*) AS count FROM books WHERE isbn = '{$this->isbn}'
                    EOD;
	}
}
