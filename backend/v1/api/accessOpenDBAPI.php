<?php
require_once(__DIR__ . '/accessAPIManager.php');


/**
 * OpenBD APIにアクセスするためのクラス
 */
final class AccessOpenDBAPI extends AccessExampleAPIManager // override
{
	private const array responseBody = [
		'isbn' => '',
		'title' => '',
		'sub_title' => '',
		'author' => '',
		'description' => '',
		'page' => '',
		'image_url' => '',
		'published_date' => '',
		'content' => ''
	];

	// override
	protected string $apiURI = 'https://api.openbd.jp/v1/get';

	// override
	protected final function CreateApiResponseBody(): array
	{
		$responseBody = $this->responseBody;

		$responsejson = json_decode($this->apiResponse, true);
	}
}
