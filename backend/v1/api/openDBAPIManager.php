<?php
require_once(__DIR__ . '/apiManager.php');

final class OpenDBApiManager extends APIManager
{
	// override
	const URI = 'https://api.openbd.jp/v1/get';
}
