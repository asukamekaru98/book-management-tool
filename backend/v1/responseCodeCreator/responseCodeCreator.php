<?php

namespace ResponseCodeCreator;

use Interfaces\I_ResponseCodeCreator;

require_once __DIR__ . '/../interfaces/i_responseCodeCreator.php';

// レスポンスコードを生成するクラス
class ResponseCodeCreator implements I_ResponseCodeCreator
{
	public function CreateResponseCode(int $httpResponseCode): int
	{
		// なにもしない
		return $httpResponseCode;
	}
}
