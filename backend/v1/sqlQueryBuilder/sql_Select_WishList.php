<?php

namespace SqlQueryBuilder;

require_once('SqlQueryBuilder.php');

final class Sql_Select_WishList extends SqlQueryBuilder_BookManagementTool
{

	public function BuildSQLQuery()
	{
		$this->sqlQuery =
			<<< "EOD"
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
			books_shelf.purchased,
			books_shelf.memo
			FROM books_shelf
			LEFT JOIN books 
			ON books.isbn = books_shelf.isbn
			WHERE books.isbn = '{$this->isbn}'
		EOD;
	}
}
