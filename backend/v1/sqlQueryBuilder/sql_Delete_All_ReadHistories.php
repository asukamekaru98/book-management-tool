<?php

namespace SqlQueryBuilder;

require_once('SqlQueryBuilder.php');

class SqlDeleteAllReadHistories extends SqlQueryBuilder_BookManagementTool
{

	public function BuildSQLQuery()
	{
		$this->sqlQuery = <<< "EOD"
                    DELETE FROM read_histories
                    EOD;
	}
}
