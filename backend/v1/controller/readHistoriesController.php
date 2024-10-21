<?php

require_once(__DIR__ . '/resourceController.php');

use SqlQueryBuilder\SqlQueryBuilderFactory;
use ReturnResponse\ReturnResponse;
use ResponseCreator\ResponseCreator;
use ResponseBodyCreator\ResponseBodyCreatorFactory;

class readHistoriesController extends resourceController
{
	// override
	public function methodGET()
	{
		switch ($this->viewed_flag) {
			case BookViewedFlag::NoViewed:
				$sqlQueryBuilder = SqlQueryBuilderFactory::SelectNoViewedReadHistories(
					$this->isbn,
					$this->data
				);
				break;

			case BookViewedFlag::Viewed:
				$sqlQueryBuilder = SqlQueryBuilderFactory::SelectViewedReadHistories(
					$this->isbn,
					$this->data
				);
				break;

			case BookViewedFlag::All:
				$sqlQueryBuilder = SqlQueryBuilderFactory::SelectAllReadHistories(
					$this->isbn,
					$this->data
				);
				break;

			default:
				throw new Exception("viewed_flag is invalid", PRECONDITION_REQUIRED_428);
		}

		// SQLクエリの実行
		$this->ExecuteSqlQuery($sqlQueryBuilder->GetSQLQuery());

		// ToDo：CreateResponseBodyで複数取得したときの処理が出来ていないかもしれないので、要確認
		$this->CreateResponse(
			new ResponseCreator(
				ResponseBodyCreatorFactory::CreateRespoonseBody_Get_ReadHistories($this->format)
			)
		);
	}

	// override
	public function methodPOST()
	{
		if ($this->IsISBNCodeNotSet()) {
			// ISBNコードが設定されていない場合、エラーを返す
			throw new Exception("ISBN code is not set", PRECONDITION_REQUIRED_428);
		}

		// SQLクエリの生成
		$sqlQueryBuilder = SqlQueryBuilderFactory::InsertReadHistories(
			$this->isbn,
			$this->data
		);

		// SQLクエリの実行
		$this->ExecuteSqlQuery($sqlQueryBuilder->GetSQLQuery());

		$this->CreateResponse(
			new ResponseCreator(
				ResponseBodyCreatorFactory::CreateRespoonseBody_Correct($this->format)
			)
		);
	}

	// override
	public function methodPUT()
	{
		if ($this->IsISBNCodeNotSet()) {
			// ISBNコードが設定されていない場合、エラーを返す
			throw new Exception("ISBN code is not set", PRECONDITION_REQUIRED_428);
		}

		// SQLクエリの生成
		$sqlQueryBuilder = SqlQueryBuilderFactory::UpdateReadHistories(
			$this->isbn,
			$this->data
		);

		// SQLクエリの実行
		$this->ExecuteSqlQuery($sqlQueryBuilder->GetSQLQuery());

		$this->CreateResponse(
			new ResponseCreator(
				ResponseBodyCreatorFactory::CreateRespoonseBody_Correct($this->format)
			)
		);
	}

	// override
	public function methodDELETE()
	{
		// SQLクエリの生成
		if ($this->IsISBNCodeNotSet()) {
			$sqlQueryBuilder = SqlQueryBuilderFactory::DeleteAllReadHistories(
				$this->isbn,
				$this->data
			);
		} else {
			$sqlQueryBuilder = SqlQueryBuilderFactory::DeleteReadHistories(
				$this->isbn,
				$this->data
			);
		}

		// SQLクエリの実行
		$this->ExecuteSqlQuery($sqlQueryBuilder->GetSQLQuery());

		$this->CreateResponse(
			new ResponseCreator(
				ResponseBodyCreatorFactory::CreateRespoonseBody_Correct($this->format)
			)
		);
	}
}
