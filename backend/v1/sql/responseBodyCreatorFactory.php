<?php
class ResponseBodyCreatorFactory
{
	public static function create(string $format): I_ResponseBodyCreator
	{
		return match ($format) {
			'json' => new JSONResponseBodyCreator(),
			'xml' => new XMLResponseBodyCreator(),
			default => throw new Exception('Unsupported format'),
		};
	}
}
