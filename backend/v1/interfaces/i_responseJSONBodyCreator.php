<?php

namespace Interfaces;

require_once __DIR__ . '/../constant/const_db.php';

interface I_ResponseJSONBodyCreator
{
	public function CreateResponseBody_JSON(array $data): string;
}
