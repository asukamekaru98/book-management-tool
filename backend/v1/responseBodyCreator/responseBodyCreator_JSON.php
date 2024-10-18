<?php

namespace ResponseBodyCreator;

use Interfaces\I_ResponseBodyCreator;

// JSON形式のレスポンスボディを生成するクラス
class ResponseBodyCreator_JSON implements I_ResponseBodyCreator
{
	public function CreateSuccessResponseBody(array $data): string
	{
		$responseJSON = json_decode(file_get_contents('../json_template/getRequestResponseBody.json'), true);
		$responseJSON['message'] = 'Correct';

		return json_encode($responseJSON);
	}

	public function CreateErrorResponseBody(array $data): string
	{
		$responseJSON = self::COMMON_RESPONSE_BODY_TEMPLATE;
		$responseJSON['message'] = $data['message'] ?? "Error";

		return json_encode($responseJSON);
	}
}
