<?php

namespace Interfaces;

require_once __DIR__ . '/../constant/const_db.php';
require_once __DIR__ . '/i_responseJSONBodyCreator.php';
require_once __DIR__ . '/i_responseXMLBodyCreator.php';

interface I_ResponseBodyCreator extends I_ResponseJSONBodyCreator, I_ResponseXMLBodyCreator
{
	public function CreateResponseBody(array $data): string;
	public function CreateResponseBody_JSON(array $data): string;
	public function CreateResponseBody_XML(array $data): string;
}
