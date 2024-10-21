<?php

namespace ResponseBodyCreator;

use Interfaces\I_ResponseBodyCreator;

require_once __DIR__ . '/../interfaces/i_responseBodyCreator.php';
require_once __DIR__ . '/../constant/const_uri.php';
require_once('responseBody_Correct.php');
require_once('responseBody_Error.php');
require_once('responseBody_Get_BookShelf.php');
require_once('responseBody_Get_WishList.php');
require_once('responseBody_Get_ReadHistories.php');

class ResponseBodyCreatorFactory
{

	public static function CreateRespoonseBody_Correct(
		string $format = URI_QUERY_DATA_FORMAT_JSON
	): I_ResponseBodyCreator {
		return new RespBodyCre8er($format);
	}

	public static function CreateRespoonseBody_Error(
		string $format = URI_QUERY_DATA_FORMAT_JSON
	): I_ResponseBodyCreator {
		return new RespBodyCre8erError($format);
	}

	public static function CreateRespoonseBody_Get_BookShelf(
		string $format = URI_QUERY_DATA_FORMAT_JSON
	): I_ResponseBodyCreator {
		return new RespBodyCre8erGetBookShelf($format);
	}

	public static function CreateRespoonseBody_Get_WishList(
		string $format = URI_QUERY_DATA_FORMAT_JSON
	): I_ResponseBodyCreator {
		return new RespBodyCre8erGetWishList($format);
	}

	public static function CreateRespoonseBody_Get_ReadHistories(
		string $format = URI_QUERY_DATA_FORMAT_JSON
	): I_ResponseBodyCreator {
		return new RespBodyCre8erGetReadHistories($format);
	}
}
