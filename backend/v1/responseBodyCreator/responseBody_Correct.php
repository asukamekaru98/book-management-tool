<?php

namespace ResponseBodyCreator;

use Interfaces\I_ResponseBodyCreator;

// JSON形式のレスポンスボディを生成するクラス
class RespBodyCre8erCorrect extends RespBodyCre8er implements I_ResponseBodyCreator
{
	public function CreateResponseBody(array $data): string
	{
		//$responseJSON = json_decode(file_get_contents('../json_template/getRequestResponseBody.json'), true);
		$responseJSON['message'] = 'Correct';

		return json_encode($responseJSON);
	}

	public function CreateResponseBody_JSON(array $data): string
	{
		$responseJSON['message'] = 'Correct';

		return json_encode($responseJSON);
	}

	public function CreateResponseBody_XML(array $data): string
	{
		$responseXML['message'] = 'Correct';

		return xmlrpc_encode($responseXML);
	}
}
