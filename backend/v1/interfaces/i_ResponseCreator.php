<?php

namespace Interfaces;

require_once __DIR__ . '/i_responseBodyCreator.php';
require_once __DIR__ . '/i_responseCodeCreator.php';

interface I_ResponseCreator
{
	public function __construct(
		protected I_ResponseCodeCreator $respCodeCreator,
		protected I_ResponseBodyCreator $respBodyCreator
	);

	public function CreateResponse(int $code, array $body): void;
	public function GetResponseCode();
	public function GetResponseBody();
}
