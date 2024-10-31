<?php

namespace ReturnResponse;

use Interfaces\I_ReturnResponse;
use Interfaces\I_ResponseCreator;

require_once __DIR__ . '/../interfaces/i_returnResponse.php';
require_once __DIR__ . '/../interfaces/i_ResponseCreator.php';

class ReturnResponse implements I_ReturnResponse
{

	public function __construct(I_ResponseCreator $responseCreator)
	{
		http_response_code($responseCreator->GetResponseCode());
		echo json_encode($responseCreator->GetResponseBody());
		echo $responseCreator->GetResponseCode();
	}

	public static function returnHttpResponse(
		I_ResponseCreator $responseCreator
	): void {
		new self($responseCreator);
	}
}
