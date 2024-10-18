<?php

namespace Interfaces;

interface I_ResponseCodeCreator
{
	public function CreateResponseCode(int $httpResponseCode): int;
}
