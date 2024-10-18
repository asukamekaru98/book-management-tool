<?php

namespace ResponseBodyCreator;

use Interfaces\I_ResponseBodyCreator;

// JSON形式のレスポンスボディを生成するクラス
class ResponseBodyCreator implements I_ResponseBodyCreator
{

	function __construct(private string $format = URI_QUERY_DATA_FORMAT_JSON) {}

	public function CreateResponseBody(array $data): string
	{

		return match ($this->format) {
			URI_QUERY_DATA_FORMAT_JSON => $this->CreateSuccessResponseBody($data),
			URI_QUERY_DATA_FORMAT_XML => $this->CreateErrorResponseBody($data),
			default => throw new \Exception('Unsupported format'),
		};
	}

	private function CreateSuccessResponseBody(array $data): string
	{
		$responseJSON = json_decode(file_get_contents('../json_template/getRequestResponseBody.json'), true);
		$responseJSON['message'] = 'Correct';

		return json_encode($responseJSON);
	}

	private function CreateErrorResponseBody(array $data): string
	{
		$responseJSON = self::COMMON_RESPONSE_BODY_TEMPLATE;
		$responseJSON['message'] = $data['message'] ?? "Error";

		echo $responseJSON['message'];

		return json_encode($responseJSON);
	}
}
