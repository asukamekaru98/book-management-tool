<?php

namespace Interfaces;

require_once __DIR__ . '/../constant/const_db.php';

interface I_ResponseBodyCreator
{
	// GETメソッドのレスポンスボディのテンプレート
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

	// 共通で使うレスポンスボディのテンプレート
	const COMMON_RESPONSE_BODY_TEMPLATE = [
		'message' => '',
	];

	// 成功時のレスポンスボディを生成する
	public function CreateSuccessResponseBody(array $data): string;
	// エラー時のレスポンスボディを生成する
	public function CreateErrorResponseBody(array $data): string;
}
