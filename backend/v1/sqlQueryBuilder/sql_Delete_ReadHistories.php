<?php

namespace SqlQueryBuilder;

require_once('SqlQueryBuilder.php');

class SqlDeleteReadHistories extends SqlQueryBuilder_BookManagementTool
{

	public function BuildSQLQuery()
	{
		$this->sqlQuery = <<< "EOD"
                    DELETE FROM read_histories
                    WHERE isbn = '{$this->isbn}'
                    EOD;
	}
}
