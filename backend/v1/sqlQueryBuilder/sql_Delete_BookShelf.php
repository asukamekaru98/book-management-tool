<?php

namespace SqlQueryBuilder;

use API\AccessOpenDBAPI;

require_once('SqlQueryBuilder.php');

class Sql_Delete_BookShelf extends SqlQueryBuilder_BookManagementTool
{

	public function BuildSQLQuery()
	{
		$this->sqlQuery = <<< "EOD"
                    DELETE FROM books_shelf
                    WHERE isbn = '{$this->isbn}'
                    EOD;
	}
}
