<?php

namespace ResponseBodyCreator;

use Interfaces\I_ResponseBodyCreator;

// XML形式のレスポンスボディを生成するクラス
class ResonseBodyCreator_Get_BookShelf extends ResponseBodyCreator implements I_ResponseBodyCreator
{
	// override
	protected function CreateResponseBody_JSON(array $data): string
	{
		$responseJSON = json_decode(file_get_contents('../json_template/getBookShelfRespBody.json'), true);

		$responseJSON['bookinfo']['isbn'] = $data['isbn'] ?? "";
		$responseJSON['bookinfo']['title'] = $data['title'] ?? "";
		$responseJSON['bookinfo']['sub_title'] = $data['title'] ?? "";
		$responseJSON['bookinfo']['author'] = $data['author'] ?? "";
		$responseJSON['bookinfo']['description'] = $data['description'] ?? "";
		$responseJSON['bookinfo']['image_url'] = $data['image_url'] ?? "";
		$responseJSON['bookinfo']['published_date'] = $data['published_date'] ?? "";
		$responseJSON['bookinfo']['content'] = $data['content'] ?? "";

		$responseJSON['userinfo']['industry_important'] = $data['industry_important'] ?? "";
		$responseJSON['userinfo']['work_important'] = $data['work_important'] ?? "";
		$responseJSON['userinfo']['user_important'] = $data['user_important'] ?? "";
		$responseJSON['userinfo']['priority'] = $data['priority'] ?? "";
		$responseJSON['userinfo']['purchased_flag'] = $data['purchased_flag'] ?? "";
		$responseJSON['userinfo']['viewed_flag'] = $data['viewed_flag'] ?? "";

		$responseJSON['book_shelf']['purchased'] = $data['purchased'] ?? "";
		$responseJSON['book_shelf']['memo'] = $data['memo'] ?? "";

		$responseJSON['message'] = $data['message'] ?? "Correct";

		return json_encode($responseJSON);
	}

	// override
	protected function CreateResponseBody_XML(array $data): string
	{
		// XML形式のレスポンスボディは未実装
		$responseXML['message'] = "XML is not supported";

		return xmlrpc_encode($responseXML);
	}
}
