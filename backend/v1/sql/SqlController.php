<?php

class SqlController
{
	const RESPONSE_BODY_TEMPLATE = [
		'bookinfo' => [
			'isbn' => '',
			'title' => '',
			'sub_title' => '',
			'author' => '',
			'description' => '',
			'image_url' => '',
			'published_date' => '',
			'content' => '',
		],
		'userinfo' => [
			'industry_important' => '',
			'work_important' => '',
			'user_important' => '',
			'priority' => '',
			'purchased_flag' => '',
			'viewed_flag' => '',
		],
	];
}
