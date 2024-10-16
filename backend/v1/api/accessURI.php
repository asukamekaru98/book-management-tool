<?php

/*
* URIにアクセスし、レスポンスを取得するクラス
*/
class AccessURI
{
	private string $apiResponse;

	function __construct(private string $sendURI) {}

	public function SetURI(string $sendURI): self
	{
		$this->sendURI = $sendURI;
		return $this;
	}

	public function AccessURI(): void
	{
		$sendURI = $this->sendURI;

		if ($sendURI === null) {
			throw new Exception('Failed to access URI', INTERNAL_SERVER_ERROR_500);
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $sendURI);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$apiResponse = curl_exec($ch);
		curl_close($ch);

		if ($apiResponse === false) {
			throw new Exception('Failed to access URI', INTERNAL_SERVER_ERROR_500);
		}

		$this->apiResponse = $apiResponse;
	}

	public function GetApiResponse(): string
	{
		return $this->apiResponse;
	}
}
