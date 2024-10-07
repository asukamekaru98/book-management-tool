<?php
interface I_ResponseBodyCreator
{
	const GET_RESPONSE_BODY_TEMPLATE = [
		'bookinfo' => [
			DB_BOOKS_ISBN => '',
			DB_BOOKS_TITLE => '',
			DB_BOOKS_SUB_TITLE => '',
			DB_BOOKS_AUTHOR => '',
			DB_BOOKS_DESCRIPTION => '',
			DB_BOOKS_IMAGE_URL => '',
			DB_BOOKS_PUBLISHED_DATE => '',
			DB_BOOKS_CONTENT => '',
		],
		'userinfo' => [
			DB_BOOKS_INDUSTORY_IMPORTANT => '',
			DB_BOOKS_WORK_IMPORTANT => '',
			DB_BOOKS_USER_IMPORTANT => '',
			DB_BOOKS_PRIORITY => '',
			DB_BOOKS_PURCHASED_FLAG => '',
			DB_BOOKS_VIEWED_FLAG => '',
		],
	];

	const CORRECT_RESPONSE_BODY_TEMPLATE = [
		'message' => '',
	];

	const ERROR_RESPONSE_BODY_TEMPLATE = [
		'error' => [
			'code' => '',
			'message' => '',
		],
	];

	public function CreateGetResponseBody(array $arraySqlResult): array;

	public function CreateSetResponseBody(array $arraySqlResult): array;

	public function CreateErrorResponseBody(array $arraySqlResult): array;
}
