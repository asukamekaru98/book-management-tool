<?php

namespace ResponseBodyCreator;

use Interfaces\I_ResponseBodyCreator;

// JSON形式のレスポンスボディを生成するクラス
class RespBodyCre8er implements I_ResponseBodyCreator
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

	public function CreateResponseBody_JSON(array $data): string
	{
		$responseJSON['message'] = $data['message'] ?? "Correct";

		return json_encode($responseJSON);
	}

	public function CreateResponseBody_XML(array $data): string
	{
		$responseXML['message'] = $data['message'] ?? "Correct";

		return xmlrpc_encode($responseXML);
	}

	// 取得したデータを元にレスポンスボディを生成するメソッド
	protected function CreateJSON($tmpPath, $data, $fields): string
	{
		$responseJSON = json_decode(file_get_contents($tmpPath), true);

		foreach ($fields as $section => $keys) {
			foreach ($keys as $key) {
				$responseJSON[$section][$key] = $data[$key] ?? ($key === 'message' ? "Operation successful" : "");
			}
		}

		return json_encode($responseJSON);
	}
}
