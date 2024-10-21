<?php

namespace Interfaces;

require_once __DIR__ . '/../constant/const_db.php';

interface I_ResponseXMLBodyCreator
{
	public function CreateResponseBody_XML(array $data): string;
}
