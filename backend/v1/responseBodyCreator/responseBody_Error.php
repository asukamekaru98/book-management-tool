<?php

namespace ResponseBodyCreator;

use Interfaces\I_ResponseBodyCreator;

// XML形式のレスポンスボディを生成するクラス
class ResonseBodyCreator_Error extends ResponseBodyCreator implements I_ResponseBodyCreator
{
	// override
	protected function CreateResponseBody_JSON(array $data): string
	{
		$responseJSON = json_decode(file_get_contents('../json_template/getRequestResponseBody.json'), true);
		$responseJSON['message'] = $data['message'] ?? "Correct";

		return json_encode($responseJSON);
	}

	// override
	protected function CreateResponseBody_XML(array $data): string
	{
		$responseXML = self::COMMON_RESPONSE_BODY_TEMPLATE;
		$responseXML['message'] = $data['message'] ?? "Correct";

		return xmlrpc_encode($responseXML);
	}
}
