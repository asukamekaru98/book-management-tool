<?php

namespace API;

use Interfaces\I_AccessAPIManager;

require_once('accessURI.php');
require_once __DIR__ . '/../interfaces/i_accessAPIManager.php';

/**
 * APIにアクセスするためのクラス
 * 仮のクラス
 */
class AccessExampleAPIManager implements I_AccessAPIManager
{
	protected string $apiURI = 'https://example.com/'; // 仮のURI
	protected $apiResponse;

	private array $optionQueries = [
		'query' => ''
	];

	public function SetOptionQueries(string $query)
	{
		$this->optionQueries = [
			'query' => $query
		];
	}

	/**
	 * APIにアクセスする
	 */
	public function AccessAPI()
	{
		$uri = $this->CreateURI();

		$accessURI = new AccessURI($uri);
		$accessURI->AccessURI();
		$this->apiResponse = $accessURI->GetApiResponse();
	}

	public function GetApiResponse(): string
	{
		return $this->apiResponse;
	}

	public function GetApiResponseBody(): array
	{
		return $this->CreateApiResponseBody();
	}

	/**
	 * URIを作成する
	 */
	protected function CreateURI()
	{
		$uri = $this->apiURI;

		if (empty($this->optionQueries)) {
			// クエリがない場合

			return $uri;
		} else {
			// クエリがある場合

			// クエリを追加
			$uri .= '?';
			foreach ($this->optionQueries as $key => $value) {
				$uri .= $value . '&';
			}

			// 最後の&を削除
			$uri = substr($uri, 0, -1);

			return $uri;
		}
	}

	protected function CreateApiResponseBody(): array
	{
		// 仮のレスポンスボディ
		$responseBody = [
			'message' => 'Correct'
		];

		return $responseBody;
	}
}
