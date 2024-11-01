<?php

namespace SqlQueryBuilder;

use API\AccessOpenDBAPI;

require_once('SqlQueryBuilder.php');
require_once __DIR__ . '/../api/AccessOpenDBAPI.php';

/**
 * 書籍情報の登録を行うクラス
 */
class Sql_Insert_BookInfo extends SqlQueryBuilder_BookManagementTool
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

		$isbn = is_array($openDBApiResponse['isbn']) ? json_encode($openDBApiResponse['isbn']) : ($openDBApiResponse['isbn'] ?? '');
		$title = is_array($openDBApiResponse['title']) ? json_encode($openDBApiResponse['title']) : ($openDBApiResponse['title'] ?? '');
		$sub_title = is_array($openDBApiResponse['sub_title']) ? json_encode($openDBApiResponse['sub_title']) : ($openDBApiResponse['sub_title'] ?? '');
		$author = is_array($openDBApiResponse['author']) ? json_encode($openDBApiResponse['author']) : ($openDBApiResponse['author'] ?? '');
		$description = is_array($openDBApiResponse['description']) ? json_encode($openDBApiResponse['description']) : ($openDBApiResponse['description'] ?? '');
		$page = is_array($openDBApiResponse['page']) ? json_encode($openDBApiResponse['page']) : ($openDBApiResponse['page'] ?? '');
		$image_url = is_array($openDBApiResponse['image_url']) ? json_encode($openDBApiResponse['image_url']) : ($openDBApiResponse['image_url'] ?? '');
		$published_date = is_array($openDBApiResponse['published_date']) ? json_encode($openDBApiResponse['published_date']) : ($openDBApiResponse['published_date'] ?? '');
		$content = is_array($openDBApiResponse['content']) ? json_encode($openDBApiResponse['content']) : ($openDBApiResponse['content'] ?? '');


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
