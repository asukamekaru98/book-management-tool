<?php

namespace ResponseBodyCreator;

use Interfaces\I_ResponseBodyCreator;
use ResponseBodyCreator\RespBodyCre8er;

require_once __DIR__ . '/../interfaces/i_responseBodyCreator.php';
require_once('responseBodyCreator.php');

// XML形式のレスポンスボディを生成するクラス
class RespBodyCre8erGetBookShelf extends RespBodyCre8er implements I_ResponseBodyCreator
{
	// override
	public function CreateResponseBody_JSON(array $data): string
	{
		$templatePath = __DIR__ . '/../json_template/getBookShelfRespBody.json';
		$responseJSON = json_decode(file_get_contents($templatePath), true);

		$fields = [
			'bookinfo' => ['isbn', 'title', 'sub_title', 'author', 'description', 'image_url', 'published_date', 'content'],
			'userinfo' => ['industry_important', 'work_important', 'user_important', 'priority', 'purchased_flag', 'viewed_flag'],
			'book_shelf' => ['purchased', 'memo'],
			'message' => ['message']
		];

		foreach ($fields as $section => $keys) {
			foreach ($keys as $key) {
				$responseJSON[$section][$key] = $data[$key] ?? ($key === 'message' ? "Operation successful" : "");
			}
		}

		return json_encode($responseJSON);
	}

	// override
	public function CreateResponseBody_XML(array $data): string
	{
		// XML形式のレスポンスボディは未実装
		$responseXML['message'] = "XML is not supported";

		return xmlrpc_encode($responseXML);
	}
}
