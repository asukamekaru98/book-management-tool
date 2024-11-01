<?php

namespace ResponseBodyCreator;

use Interfaces\I_ResponseBodyCreator;
use Exception;

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
	protected function generateJsonResponse($tmpPath, $data, $fields): string
	{
		if (!file_exists(filename: $tmpPath)) {
			throw new Exception(message: "File not found: $tmpPath", code: VARIANT_ALSO_NEGOTIATES_506);
		}

		$fileContents = file_get_contents($tmpPath);
		if ($fileContents === false) {
			throw new Exception(message: "Failed to read file: $tmpPath", code: BAD_REQUEST_400);
		}

		$JSON = json_decode(json: $fileContents, associative: true);

		$mergedResponseJSON = [];

		for ($idx = 0; !empty($data[$idx]); $idx++) {
			foreach ($fields as $section => $keys) {
				foreach ($keys as $key) {

					if (empty($data[$idx][$key])) {
						$str = "none";
					} else {
						$str = $data[$idx][$key];
					}

					$JSON[$section][$key] = $str;

					//print_r($JSON[$section][$key]);
					//print("<br>");
				}
			}
			$responseJSON[] = $JSON;
			//$mergedResponseJSON[] = array_merge($JSON, $mergedResponseJSON);
		}

		//print_r($responseJSON);
		//print("<br>");

		//$mergedResponseJSON = [];

		//foreach ($responseJSON as $json) {

		//	print_r($json);
		//	print("<br>");

		//	$mergedResponseJSON = array_merge($mergedResponseJSON, $json);
		//}

		$responseJSON[] = array('message' => 'Operation successful');


		return json_encode($responseJSON);
	}
}
