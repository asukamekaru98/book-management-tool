<?php

namespace SqlQueryBuilder;

require_once('SqlQueryBuilder.php');

class Sql_IsIsbnCodeDuplicateInWishList extends Sql_IsIsbnCodeDuplicate
{
	// override
	public function BuildSQLQuery()
	{
		if (empty($this->isbn)) {
			return;
		}

		$this->sqlQuery = <<< "EOD"
					SELECT COUNT(*) AS count FROM wish_list WHERE isbn = '{$this->isbn}'
					EOD;
	}
}
