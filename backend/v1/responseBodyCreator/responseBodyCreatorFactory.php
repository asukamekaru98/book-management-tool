<?php

namespace ResponseBodyCreator;

use Interfaces\I_ResponseBodyCreator;

require_once __DIR__ . '/../interfaces/i_responseBodyCreator.php';
require_once __DIR__ . '/../constant/const_uri.php';
require_once('responseBodyCreator_JSON.php');
require_once('responseBodyCreator_XML.php');

class ResponseBodyCreatorFactory
{
	public static function CreateRespoonseBody(string $format = URI_QUERY_DATA_FORMAT_JSON): I_ResponseBodyCreator
	{
		return match ($format) {
			URI_QUERY_DATA_FORMAT_JSON => new ResponseBodyCreator_JSON(),
			URI_QUERY_DATA_FORMAT_XML => new ResponseBodyCreator_XML(),
			default => throw new \Exception('Unsupported format'),
		};
	}
}
