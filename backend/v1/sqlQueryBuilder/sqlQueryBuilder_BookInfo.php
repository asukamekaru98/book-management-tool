<?php

namespace SqlQueryBuilder;

use Interfaces\I_SqlQueryBuilder;

/**
 * 書籍情報の登録を行うクラス
 */
class SqlBuilder_BookInfo implements I_SqlQueryBuilder
{
	private string $sqlQuery = '';

	public function __construct(
		private string $isbn,
		private string $industry_important,
		private string $work_important,
		private string $user_important,
		private string $priority,
		private string $purchased_flag,
		private string $viewed_flag
	) {
		$this->BuildSQL();
	}


	public function BuildSQL()
	{
		if (empty($this->isbn)) {
			return;
		}

		// OpenBD APIにアクセス
		$accessOpenDBAPI = new AccessOpenDBAPI();
		$accessOpenDBAPI->SetOptionQueries("isbn={$this->isbn}");
		$accessOpenDBAPI->AccessAPI();
		$openDBApiResponse = $accessOpenDBAPI->GetApiResponseBody();

		$isbn = $openDBApiResponse['isbn'] ?? '';
		$title = $openDBApiResponse['title'] ?? '';
		$sub_title = $openDBApiResponse['sub_title'] ?? '';
		$author = $openDBApiResponse['author'] ?? '';
		$description = $openDBApiResponse['description'] ?? '';
		$page = $openDBApiResponse['page'] ?? '';
		$image_url = $openDBApiResponse['image_url'] ?? '';
		$published_date = $openDBApiResponse['published_date'] ?? '';
		$content = $openDBApiResponse['content'] ?? '';


		$this->sqlQuery = <<< "EOD"
                    INSERT INTO books (isbn, title, sub_title, author, description, page, image_url, published_date, content, industry_important, work_important, user_important, priority, purchased_flag, viewed_flag)
                    VALUES (
                        '{$isbn}',
                        '{$title}',
                        '{$sub_title}',
                        '{$author}',
                        '{$description}',
                        '{$page}',
                        '{$image_url}',
                        '{$published_date}',
                        '{$content}',
                        '{$this->industry_important}', 
                        '{$this->work_important}', 
                        '{$this->user_important}', 
                        '{$this->priority}', 
                        '{$this->purchased_flag}',
                        '{$this->viewed_flag}')
                    EOD;
	}

	public function GetSQLQuery(): string
	{
		return $this->sqlQuery;
	}
}
