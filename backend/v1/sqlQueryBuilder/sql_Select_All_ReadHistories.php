<?php

namespace SqlQueryBuilder;

require_once('SqlQueryBuilder.php');

class SqlSelectAllBookShelf extends SqlQueryBuilder_BookManagementTool
{
	// override
	public function BuildSQLQuery()
	{

		$this->sqlQuery = <<< "EOD"
					SELECT 
						books.isbn,
						books.title,
						books.sub_title,
						books.author,
						books.description,
						books.page,
						books.image_url,
						books.published_date,
						books.content,
						books.industry_important,
						books.work_important,
						books.user_important,
						books.priority,
						books.purchased_flag,
						books.viewed_flag,
						read_histories.view_start,
						read_histories.view_end,
						read_histories.impression,
						read_histories.memo,
						read_histories.understanding
					FROM 
						read_histories
					LEFT JOIN 
						books
					ON 
						books.isbn = read_histories.isbn
					EOD;
	}
}
