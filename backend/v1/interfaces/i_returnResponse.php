<?php

namespace Interfaces;

interface I_ReturnResponse
{
	public function __construct(int $httpResponseCode, array $responseBody);
}
