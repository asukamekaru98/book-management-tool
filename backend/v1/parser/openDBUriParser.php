<?php
require_once(__DIR__ . '/uriParser.php');

class openDBUriParser extends URIParser
{
	private $data = [];
	private $dataISBN;
	private $dataTitle;
	private $dataSubTitle;
	private $dataAuthor;
	private $dataDescription;
	private $dataPage;
	private $dataImageURL;
	private $dataPublishedDate;
	private $dataContent;


	// override
	public function ParseAPIResponse()
	{
		$responsejson = json_decode($this->apiResponse, true);


		print_r($responsejson);

		$this->dataISBN = $responsejson['onix']['DescriptiveDetail']['ProductIdentifier']['IDValue'];
		$this->dataTitle = $responsejson['onix']['DescriptiveDetail']['TitleDetail']['TitleElement']['TitleText'];
		$this->dataSubTitle = $responsejson['onix']['DescriptiveDetail']['TitleDetail']['TitleElement']['Subtitle'];
		$this->dataAuthor = $responsejson['onix']['DescriptiveDetail']['Contributor']['0']['PersonName'];
		$this->dataDescription = $responsejson['onix']['CollateralDetail']['TextContent']['0']['Text'];
		$this->dataPage = $responsejson['onix']['DescriptiveDetail']['Extent']['0']['ExtentValue'];
		$this->dataImageURL = $responsejson['onix']['CollateralDetail']['SupportingResource']['0']['ResourceVersion']['ResourceLink'];
		$this->dataPublishedDate = $responsejson['onix']['PublishingDetail']['PublishingDate']['0']['Date'];
		$this->dataContent = $responsejson['onix']['CollateralDetail']['TextContent']['0']['Text'];
	}

	public function GetData()
	{
		return $this->data;
	}

	public function GetDataISBN()
	{
		return $this->dataISBN;
	}

	public function GetDataTitle()
	{
		return $this->dataTitle;
	}

	public function GetDataSubTitle()
	{
		return $this->dataSubTitle;
	}

	public function GetDataAuthor()
	{
		return $this->dataAuthor;
	}

	public function GetDataDescription()
	{
		return $this->dataDescription;
	}

	public function GetDataPage()
	{
		return $this->dataPage;
	}

	public function GetDataImageURL()
	{
		return $this->dataImageURL;
	}

	public function GetDataPublishedDate()
	{
		return $this->dataPublishedDate;
	}

	public function GetDataContent()
	{
		return $this->dataContent;
	}
}
