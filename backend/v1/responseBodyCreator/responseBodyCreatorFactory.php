<?php

namespace ResponseBodyCreator;

use Interfaces\I_ResponseBodyCreator;

require_once __DIR__ . '/../interfaces/i_responseBodyCreator.php';
require_once __DIR__ . '/../constant/const_uri.php';
require_once('responseBody_Correct.php');
require_once('responseBody_Error.php');
require_once('responseBody_Get_BookShelf.php');

class ResponseBodyCreatorFactory
{

	public static function CreateRespoonseBody_Correct(
		string $format = URI_QUERY_DATA_FORMAT_JSON
	): I_ResponseBodyCreator {
		return new ResponseBodyCreator($format);
	}

	public static function CreateRespoonseBody_Error(
		string $format = URI_QUERY_DATA_FORMAT_JSON
	): I_ResponseBodyCreator {
		return new ResonseBodyCreator_Error($format);
	}

	public static function CreateRespoonseBody_Get_BookShelf(
		string $format = URI_QUERY_DATA_FORMAT_JSON
	): I_ResponseBodyCreator {
		return new ResonseBodyCreator_Get_BookShelf($format);
	}
}
