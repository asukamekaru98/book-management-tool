<?php

namespace ResponseBodyCreator;

use Interfaces\I_ResponseBodyCreator;

class ResponseBodyCreatorFactory
{
	public static function Create(string $format): I_ResponseBodyCreator
	{
		return match ($format) {
			URI_QUERY_DATA_FORMAT_JSON => new ResponseBodyCreator_JSON(),
			URI_QUERY_DATA_FORMAT_XML => new ResponseBodyCreator_XML(),
			default => throw new \Exception('Unsupported format'),
		};
	}
}
