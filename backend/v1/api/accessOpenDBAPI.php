<?php

namespace API;

use API\AccessExampleAPIManager;

require_once('AccessAPIManager.php');

/**
 * OpenBD APIにアクセスするためのクラス
 */
final class AccessOpenDBAPI extends AccessExampleAPIManager // override
{
	private $templateResponseBody = [
		'isbn' => '',
		'title' => '',
		'sub_title' => '',
		'author' => '',
		'description' => '',
		'page' => '',
		'image_url' => '',
		'published_date' => '',
		'content' => ''
	];

	// override
	protected string $apiURI = 'https://api.openbd.jp/v1/get';

	// override
	protected final function CreateApiResponseBody(): array
	{
		$json = json_decode($this->apiResponse, true);

		$responseBody = $this->templateResponseBody;

		$isbn = $json[0]['summary']['isbn'] ?? '';
		$title = $json[0]['summary']['title'] ?? '';
		$sub_title = $json[0]['onix']['DescriptiveDetail']['TitleDetail']['Subtitle'] ?? '';
		$author = $json[0]['summary']['author'] ?? '';
		$description = $json[0]['onix']['CollateralDetail']['TextContent'] ?? '';
		$page = $json[0]['summary']['volume'] ?? '';
		$image_url = $json[0]['onix']['CollateralDetail']['SupportingResource']['SupportingResource']['ResourceLink'] ?? '';
		$published_date = $json[0]['summary']['pubdate'] ?? '';
		$content = $json[0]['summary']['series'] ?? '';

		if (empty($isbn)) {
			$responseBody['isbn'] = '0000000000000';
		} else {
			$responseBody['isbn'] = $isbn;
		}

		if (empty($title)) {
			$responseBody['title'] = 'No Title';
		} else {
			$responseBody['title'] = $title;
		}

		if (empty($sub_title)) {
			$responseBody['sub_title'] = 'No Sub Title';
		} else {
			$responseBody['sub_title'] = $sub_title;
		}

		if (empty($author)) {
			$responseBody['author'] = 'No Author';
		} else {
			$responseBody['author'] = $author;
		}

		if (empty($description)) {
			$responseBody['description'] = 'No Description';
		} else {
			$responseBody['description'] = $description;
		}

		if (empty($page)) {
			$responseBody['page'] = '0';
		} else {
			$responseBody['page'] = $page;
		}

		if (empty($image_url)) {
			$responseBody['image_url'] = 'No Image';
		} else {
			$responseBody['image_url'] = $image_url;
		}

		if (empty($published_date)) {
			$responseBody['published_date'] = '199802';
		} else {
			$responseBody['published_date'] = $published_date;
		}

		if (empty($content)) {
			$responseBody['content'] = 'No Content';
		} else {
			$responseBody['content'] = $content;
		}



		/*
		$responseBody['isbn'] = $json[0]['summary']['isbn'] ?? '';
		$responseBody['title'] = $json[0]['summary']['title'] ?? '';
		$responseBody['sub_title'] = $json[0]['onix']['DescriptiveDetail']['TitleDetail']['Subtitle'] ?? '';
		$responseBody['author'] = $json[0]['summary']['author'] ?? '';
		$responseBody['description'] = $json[0]['onix']['CollateralDetail']['TextContent'] ?? '';
		$responseBody['page'] = $json[0]['summary']['volume'] ?? '';
		$responseBody['image_url'] = $json[0]['onix']['CollateralDetail']['SupportingResource']['SupportingResource']['ResourceLink'] ?? '';
		$responseBody['published_date'] = $json[0]['summary']['pubdate'] ?? '';
		$responseBody['content'] = $json[0]['summary']['series'] ?? '';
*/
		//作者名から「、」を取り除く
		$responseBody['author'] = str_replace(',', '', $responseBody['author']);

		return $responseBody;
	}
}
