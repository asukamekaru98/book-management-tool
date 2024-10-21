<?php

require_once(__DIR__ . '/resourceController.php');

use SqlQueryBuilder\SqlQueryBuilderFactory;
use ReturnResponse\ReturnResponse;
use ResponseCreator\ResponseCreator;
use ResponseBodyCreator\ResponseBodyCreatorFactory;

class wishListController extends resourceController
{
	// override
	public function methodGET()
	{
		if ($this->IsISBNCodeNotSet()) {
			$sqlQueryBuilder = SqlQueryBuilderFactory::SelectWishList(
				$this->isbn,
				$this->data
			);
		} else {
			$sqlQueryBuilder = SqlQueryBuilderFactory::SelectAllWishList(
				$this->isbn,
				$this->data
			);
		}

		// SQLクエリの実行
		$this->ExecuteSqlQuery($sqlQueryBuilder->GetSQLQuery());

		// ToDo：CreateResponseBodyで複数取得したときの処理が出来ていないかもしれないので、要確認
		$this->CreateResponse(
			new ResponseCreator(
				ResponseBodyCreatorFactory::CreateRespoonseBody_Get_WishList($this->format)
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
		$sqlQueryBuilder = SqlQueryBuilderFactory::InsertWishList(
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
		$sqlQueryBuilder = SqlQueryBuilderFactory::UpdateWishList(
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
		if ($this->IsISBNCodeNotSet()) {
			// ISBNコードが設定されていない場合、エラーを返す
			throw new Exception("ISBN code is not set", PRECONDITION_REQUIRED_428);
		}

		// SQLクエリの生成
		$sqlQueryBuilder = SqlQueryBuilderFactory::DeleteWishList(
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
}
