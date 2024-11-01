<?php

namespace ResponseBodyCreator;

use Interfaces\I_ResponseBodyCreator;
use ResponseBodyCreator\RespBodyCre8er;

require_once __DIR__ . '/../interfaces/i_responseBodyCreator.php';
require_once('responseBodyCreator.php');

// XML形式のレスポンスボディを生成するクラス
class RespBodyCre8erGetWishList extends RespBodyCre8er implements I_ResponseBodyCreator
{
	// override
	public function CreateResponseBody_JSON(array $data): string
	{
		$templatePath = __DIR__ . '/../json_template/getBookShelfRespBody.json';

		$fields = [
			'bookinfo' => ['isbn', 'title', 'sub_title', 'author', 'description', 'image_url', 'published_date', 'content'],
			'userinfo' => ['industry_important', 'work_important', 'user_important', 'priority', 'purchased_flag', 'viewed_flag'],
			'wish_list' => ["memo"],
			'message' => ['message']
		];

		return $this->CreateJSON($templatePath, $data, $fields);
	}


	// override
	public function CreateResponseBody_XML(array $data): string
	{
		// XML形式のレスポンスボディは未実装
		$responseXML['message']['message'] = "XML is not supported";

		return xmlrpc_encode($responseXML);
	}
}
