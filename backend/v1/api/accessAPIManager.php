<?php
require_once(__DIR__ . '/accessURI.php');

interface I_AccessAPIManager
{

	public function AccessAPI();	// APIにアクセスする

	// クエリの設定
	// 例: SetOptionQueries('isbn=9780000000000');
	public function SetOptionQueries(string $query);
	public function GetApiResponse(): string;	// APIのレスポンスを取得
	public function GetApiResponseBody(): array;	// APIのレスポンスボディを取得
}

/**
 * APIにアクセスするためのクラス
 * 仮のクラス
 */
class AccessExampleAPIManager implements I_AccessAPIManager
{
	protected string $apiURI = 'https://example.com/'; // 仮のURI
	private $apiResponse;

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

		echo $uri;

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
