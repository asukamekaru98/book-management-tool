<?php

namespace Interfaces;

require_once __DIR__ . '/i_responseBodyCreator.php';
require_once __DIR__ . '/i_responseCodeCreator.php';

interface I_ResponseCreator
{
	public function CreateResponse(int $code, array $body): void;
	public function GetResponseCode();
	public function GetResponseBody();
}
