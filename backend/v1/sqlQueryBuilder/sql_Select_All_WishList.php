<?php

namespace SqlQueryBuilder;

require_once('SqlQueryBuilder.php');

final class Sql_Select_All_WishList extends SqlQueryBuilder_BookManagementTool
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
			wish_list.memo
			FROM wish_list
			LEFT JOIN books
			ON books.isbn = wish_list.isbn
		EOD;
	}
}
