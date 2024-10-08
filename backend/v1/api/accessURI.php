<?php

class AccessURI
{
	private string $apiResponse;


	function __construct(
		private string $sendURI,
	) {}

	public function AccessURI()
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
			return;
		}

		$this->apiResponse = $apiResponse;
	}

	public function GetApiResponse()
	{
		return $this->apiResponse;
	}
}
