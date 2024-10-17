<?php

namespace SqlQueryBuilder;

use API\AccessOpenDBAPI;

/**
 * 書籍情報の登録を行うクラス
 */
class SqlQueryBuilder_Insert_BookInfo extends SqlQueryBuilder_BookManagementTool
{
	// override
	public function BuildSQLQuery()
	{
		if (empty($this->isbn)) {
			return;
		}

		$industry_important = $this->data['industry_important'] ?? 0;
		$work_important = $this->data['work_important'] ?? 0;
		$user_important = $this->data['user_important'] ?? 0;
		$priority = $this->data['priority'] ?? 0;
		$purchased_flag = $this->data['purchased_flag'] ?? 0;
		$viewed_flag = $this->data['viewed_flag'] ?? 0;


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
                        '{$industry_important}', 
                        '{$work_important}', 
                        '{$user_important}', 
                        '{$priority}', 
                        '{$purchased_flag}',
                        '{$viewed_flag}')
                    EOD;
	}
}
