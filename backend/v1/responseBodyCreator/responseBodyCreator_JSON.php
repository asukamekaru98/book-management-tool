<?php

namespace ResponseBodyCreator;

use Interfaces\I_ResponseBodyCreator;

// JSON形式のレスポンスボディを生成するクラス
class ResponseBodyCreator_JSON implements I_ResponseBodyCreator
{
	public function CreateSuccessResponseBody(array $data): string
	{
		$responseJSON = self::COMMON_RESPONSE_BODY_TEMPLATE;
		$responseJSON['message'] = 'Correct';

		return json_encode($responseJSON);
	}

	public function CreateErrorResponseBody(array $data): string
	{
		$responseJSON = self::COMMON_RESPONSE_BODY_TEMPLATE;
		$responseJSON['message'] = 'Error';

		return json_encode($responseJSON);
	}
}
/*
class ResponseBodyGenerator implements I_ResponseBodyCreator
{
	protected array $responseBody = [];

	public function __construct(protected string $httpResponseFormat) {}

	public function CreateResponseBody(array $arraySqlResult)
	{

		if ($this->httpResponseFormat === URI_QUERY_DATA_FORMAT_JSON) {
			$responseBody = $this->CreateResponseBody_JSON($arraySqlResult);
		} else {
			$responseBody = $this->CreateResponseBody_XML($arraySqlResult);
		}

		if ($responseBody === false || $responseBody === null) {
			throw new Exception('Failed to create response body', INTERNAL_SERVER_ERROR_500);
			return;
		}

		$this->responseBody = $responseBody;
	}
	
	public function CreateResponseBody_JSON(array $arraySqlResult): string
	{
		$responseJSON = self::CORRECT_RESPONSE_BODY_TEMPLATE;
		$responseJSON['message'] = 'Correct';
		return json_encode($responseJSON);
	}

	public function CreateResponseBody_XML(array $arraySqlResult)
	{
		$responseXML = self::ERROR_RESPONSE_BODY_TEMPLATE;
		$responseXML['message'] = 'Correct';

		return xmlrpc_encode($responseXML);
	}

	public function GetResponseBody(): array
	{
		return $this->responseBody;
	}
}

class GetResponseBodyGenerator extends ResponseBodyGenerator
{
	public function __construct(protected string $httpResponseFormat)
	{
		$this->responseBody = [];
	}

	public function CreateResponseBody(array $arraySqlResult)
	{

		if ($this->httpResponseFormat === URI_QUERY_DATA_FORMAT_JSON) {
			$responseBody = $this->CreateResponseBody_JSON($arraySqlResult);
		} else {
			$responseBody = $this->CreateResponseBody_XML($arraySqlResult);
			throw new Exception('Not supported format', UNSUPPORTED_MEDIA_TYPE_415);
			return;
		}

		if ($responseBody === false || $responseBody === null) {
			throw new Exception('Failed to create response body', INTERNAL_SERVER_ERROR_500);
			return;
		}

		$this->responseBody = $responseBody;
	}

	public function CreateResponseBody_JSON(array $arraySqlResult): string
	{
		$responseJSON = self::GET_RESPONSE_BODY_TEMPLATE;
		$responseJSON['bookinfo'][DB_BOOKS_ISBN]                = $arraySqlResult[DB_BOOKS_ISBN];
		$responseJSON['bookinfo'][DB_BOOKS_TITLE]               = $arraySqlResult[DB_BOOKS_TITLE];
		$responseJSON['bookinfo'][DB_BOOKS_SUB_TITLE]           = $arraySqlResult[DB_BOOKS_SUB_TITLE];
		$responseJSON['bookinfo'][DB_BOOKS_AUTHOR]              = $arraySqlResult[DB_BOOKS_AUTHOR];
		$responseJSON['bookinfo'][DB_BOOKS_DESCRIPTION]         = $arraySqlResult[DB_BOOKS_DESCRIPTION];
		$responseJSON['bookinfo'][DB_BOOKS_IMAGE_URL]           = $arraySqlResult[DB_BOOKS_IMAGE_URL];
		$responseJSON['bookinfo'][DB_BOOKS_PUBLISHED_DATE]      = $arraySqlResult[DB_BOOKS_PUBLISHED_DATE];
		$responseJSON['bookinfo'][DB_BOOKS_CONTENT]             = $arraySqlResult[DB_BOOKS_CONTENT];

		$responseJSON['userinfo'][DB_BOOKS_INDUSTORY_IMPORTANT] = $arraySqlResult[DB_BOOKS_INDUSTORY_IMPORTANT];
		$responseJSON['userinfo'][DB_BOOKS_WORK_IMPORTANT]      = $arraySqlResult[DB_BOOKS_WORK_IMPORTANT];
		$responseJSON['userinfo'][DB_BOOKS_USER_IMPORTANT]      = $arraySqlResult[DB_BOOKS_USER_IMPORTANT];
		$responseJSON['userinfo'][DB_BOOKS_PRIORITY]            = $arraySqlResult[DB_BOOKS_PRIORITY];
		$responseJSON['userinfo'][DB_BOOKS_PURCHASED_FLAG]      = $arraySqlResult[DB_BOOKS_PURCHASED_FLAG];
		$responseJSON['userinfo'][DB_BOOKS_VIEWED_FLAG]         = $arraySqlResult[DB_BOOKS_VIEWED_FLAG];
		return json_encode($responseJSON);
	}

	public function CreateResponseBody_XML(array $arraySqlResult)
	{
		$responseXML = self::ERROR_RESPONSE_BODY_TEMPLATE;
		$responseXML['error']['message'] = 'Not implemented';

		return xmlrpc_encode($responseXML);
	}

	public function GetResponseBody(): array
	{
		return $this->responseBody;
	}
		
}
*/