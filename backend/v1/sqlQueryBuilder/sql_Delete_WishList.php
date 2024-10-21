<?php

namespace SqlQueryBuilder;

require_once('SqlQueryBuilder.php');

class SqlDeleteWishList extends SqlQueryBuilder_BookManagementTool
{

	public function BuildSQLQuery()
	{
		$this->sqlQuery = <<< "EOD"
                    DELETE FROM wish_list
                    WHERE isbn = '{$this->isbn}'
                    EOD;
	}
}
