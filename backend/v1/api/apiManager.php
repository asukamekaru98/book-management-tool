<?php
require_once(__DIR__ . '/accessURI.php');

interface I_APIMAnager
{
	const URI = 'https://example.com/';

	public function SetOptionQueries(string $query, string $format);
	public function AccessAPI();
}

class APIManager implements I_APIMAnager
{
	private array $optionQueries = [
		'query' => '',
		'value' => ''
	];

	public function __construct(
		protected I_URIParser $uriParser
	) {}

	public function SetOptionQueries(string $query, string $value)
	{
		$this->optionQueries = [
			'query' => $query,
			'value' => $value
		];
	}

	public final function AccessAPI()
	{
		if ($this->uriParser === null) {
			throw new Exception('Failed to access URI', INTERNAL_SERVER_ERROR_500);
		}


		$uri = $this->CreateURI();

		$accessURI = new AccessURI($uri);
		$accessURI->AccessURI();
		$this->uriParser->SetAPIResponse($accessURI->GetApiResponse());
	}

	private function CreateURI()
	{
		$uri = self::URI;

		if (empty($this->optionQueries)) {
			// クエリがない場合

			return $uri;
		} else {
			// クエリがある場合

			// クエリを追加
			$uri .= '?';
			foreach ($this->optionQueries as $key => $value) {
				$uri .= $key . '=' . $value . '&';
			}

			// 最後の&を削除
			$uri = substr($uri, 0, -1);

			return $uri;
		}
	}
}
