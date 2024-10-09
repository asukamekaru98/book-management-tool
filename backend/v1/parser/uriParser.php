<?php
/*
 * URIを解析するクラス
 */
interface I_URIParser
{
	protected $apiResponse;


	// APIレスポンスをセットする
	public function SetAPIResponse($apiResponse);

	// URIを解析する
	public function ParseAPIResponse();
}

class URIParser implements I_URIParser
{


	public final function SetAPIResponse($apiResponse)
	{
		$this->$apiResponse = $apiResponse;
	}

	public function ParseAPIResponse()
	{
		return json_decode($this->apiResponse, true);
	}
}
