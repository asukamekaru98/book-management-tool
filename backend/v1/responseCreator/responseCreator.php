<?php

namespace ResponseCreator;

use Interfaces\I_ResponseCreator;
use Interfaces\I_ResponseBodyCreator;
use Interfaces\I_ResponseCodeCreator;

use ResponseCodeCreator\ResponseCodeCreator;
use ResponseBodyCreator\RespBodyCre8er;

require_once __DIR__ . '/../interfaces/i_responseBodyCreator.php';
require_once __DIR__ . '/../interfaces/i_responseCodeCreator.php';

class ResponseCreator implements I_ResponseCreator
{
	private int $returnCode;
	private string $returnBody;

	public function __construct(
		protected I_ResponseBodyCreator $respBodyCreator = new RespBodyCre8er(),
		protected I_ResponseCodeCreator $respCodeCreator = new ResponseCodeCreator()
	) {}

	public function CreateResponse(int $code, array $body): void
	{
		$this->returnCode = $this->respCodeCreator->CreateResponseCode($code);
		$this->returnBody = $this->respBodyCreator->CreateResponseBody($body);
	}


	public function GetResponseCode(): int
	{
		return $this->returnCode;
	}

	public function GetResponseBody(): string
	{
		return $this->returnBody;
	}
}
