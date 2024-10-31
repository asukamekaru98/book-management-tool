<?php

require_once(__DIR__ . '/resourceController.php');

use SqlQueryBuilder\SqlQueryBuilderFactory;
use ResponseCreator\ResponseCreator;
use ResponseBodyCreator\ResponseBodyCreatorFactory;
use ResponseCodeCreator\ResponseCodeCreator;

class readHistoriesController extends resourceController
{
	// override
	public function methodGET()
	{
		switch ($this->viewed_flag) {
			case BOOK_VIEWED_FLAG_NOVIEWED:
				$sqlQueryBuilder = SqlQueryBuilderFactory::SelectNoViewedReadHistories(
					$this->isbn,
					$this->data
				);
				break;

			case BOOK_VIEWED_FLAG_VIEWED:
				$sqlQueryBuilder = SqlQueryBuilderFactory::SelectViewedReadHistories(
					$this->isbn,
					$this->data
				);
				break;

			case BOOK_VIEWED_FLAG_ALL:
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
				ResponseBodyCreatorFactory::CreateRespoonseBody_Get_ReadHistories($this->format),
				new ResponseCodeCreator()
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
				ResponseBodyCreatorFactory::CreateRespoonseBody_Correct($this->format),
				new ResponseCodeCreator()
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
				ResponseBodyCreatorFactory::CreateRespoonseBody_Correct($this->format),
				new ResponseCodeCreator()
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
				ResponseBodyCreatorFactory::CreateRespoonseBody_Correct($this->format),
				new ResponseCodeCreator()
			)
		);
	}
}
