<?php

namespace Interfaces;

require_once __DIR__ . '/../constant/const_db.php';

interface I_ResponseBodyCreator extends I_ResponseJSONBodyCreator, I_ResponseXMLBodyCreator
{
	public function CreateResponseBody(array $data): string;
}
