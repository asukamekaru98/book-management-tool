<?php

namespace ResponseBodyCreator;

use Interfaces\I_ResponseBodyCreator;

// JSON形式のレスポンスボディを生成するクラス
class ResponseBodyCreator implements I_ResponseBodyCreator
{
	public function __construct(
		protected string $format = URI_QUERY_DATA_FORMAT_JSON
	) {}

	public function CreateResponseBody(array $data): string
	{
		return match ($this->format) {
			URI_QUERY_DATA_FORMAT_JSON => $this->CreateResponseBody_JSON($data),
			URI_QUERY_DATA_FORMAT_XML => $this->CreateResponseBody_XML($data),
			default => throw new \Exception('Unsupported format', BAD_REQUEST_400),
		};
	}

	protected function CreateResponseBody_JSON(array $data): string
	{
		$responseJSON = json_decode(file_get_contents('../json_template/getRequestResponseBody.json'), true);
		$responseJSON['message'] = $data['message'] ?? "Correct";

		return json_encode($responseJSON);
	}

	protected function CreateResponseBody_XML(array $data): string
	{
		$responseXML = self::COMMON_RESPONSE_BODY_TEMPLATE;
		$responseXML['message'] = $data['message'] ?? "Correct";

		return xmlrpc_encode($responseXML);
	}
}
