<?php
require_once(__DIR__ . '/uriParser.php');

class openDBUriParser extends URIParser
{
	private $data = [];

	// override
	public function ParseAPIResponse()
	{
		$responsejson = json_decode($this->apiResponse, true);

		$this->data['isbn'] = $responsejson['onix']['DescriptiveDetail']['ProductIdentifier']['IDValue'];
		$this->data['title'] = $responsejson['onix']['DescriptiveDetail']['TitleDetail']['TitleElement']['TitleText'];
		$this->data['subTitle'] = $responsejson['onix']['DescriptiveDetail']['TitleDetail']['TitleElement']['Subtitle'];
		$this->data['author'] = $responsejson['onix']['DescriptiveDetail']['Contributor']['0']['PersonName'];
		$this->data['description'] = $responsejson['onix']['CollateralDetail']['TextContent']['0']['Text'];
		$this->data['imageURL'] = $responsejson['onix']['CollateralDetail']['SupportingResource']['0']['ResourceVersion']['ResourceLink'];
		$this->data['publishedDate'] = $responsejson['onix']['PublishingDetail']['PublishingDate']['0']['Date'];
		$this->data['content'] = $responsejson['onix']['CollateralDetail']['TextContent']['0']['Text'];
	}

	public function GetData()
	{
		return $this->data;
	}
}
