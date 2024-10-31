<?php

namespace ResponseBodyCreator;

use Interfaces\I_ResponseBodyCreator;
use ResponseBodyCreator\RespBodyCre8er;

require_once __DIR__ . '/../interfaces/i_responseBodyCreator.php';
require_once('responseBodyCreator.php');

// XML形式のレスポンスボディを生成するクラス
class RespBodyCre8erError extends RespBodyCre8er implements I_ResponseBodyCreator
{
	// override
	public function CreateResponseBody_JSON(array $data): string
	{
		$responseJSON['message'] = $data['message'] ?? "Error";

		return json_encode($responseJSON);
	}

	// override
	public function CreateResponseBody_XML(array $data): string
	{
		$responseXML['message'] = $data['message'] ?? "Error";

		return xmlrpc_encode($responseXML);
	}
}
