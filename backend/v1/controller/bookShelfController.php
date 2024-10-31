<?php

use SqlQueryBuilder\SqlQueryBuilderFactory;
use ResponseCreator\ResponseCreator;
use ResponseBodyCreator\ResponseBodyCreatorFactory;
use ResponseCodeCreator\ResponseCodeCreator;

require_once(__DIR__ . '/resourceController.php');
require_once(__DIR__ . '/../sql/sqlManager.php');
require_once(__DIR__ . '/../sqlQueryBuilder/sqlQueryBuilderFactory.php');
require_once __DIR__ . '/../returnResponse/returnResponse.php';
require_once __DIR__ . '/../responseCreator/responseCreator.php';

class bookShelfController extends resourceController
{

    // override
    function methodGET()
    {

        if ($this->IsISBNCodeNotSet()) {
            $bookShelfSQLQueryBuilder = SqlQueryBuilderFactory::SelectBookShelf(
                $this->isbn,
                $this->data
            );
        } else {
            $bookShelfSQLQueryBuilder = SqlQueryBuilderFactory::SelectAllBookShelf(
                $this->isbn,
                $this->data
            );
        }

        $this->ExecuteSqlQuery($bookShelfSQLQueryBuilder->GetSQLQuery());

        // ToDo：CreateResponseBodyで複数取得したときの処理が出来ていないかもしれないので、要確認
        $this->CreateResponse(
            new ResponseCreator(
                ResponseBodyCreatorFactory::CreateRespoonseBody_Get_BookShelf($this->format),
                new ResponseCodeCreator()
            )
        );
    }

    // override
    function methodPOST()
    {
        if ($this->IsISBNCodeNotSet()) {
            // ISBNコードが設定されていない場合、エラーを返す
            throw new Exception("ISBN code is not set", PRECONDITION_REQUIRED_428);
        }

        // SQLクエリの生成
        $bookShelfSQLQueryBuilder = SqlQueryBuilderFactory::InsertBookShelf(
            $this->isbn,
            $this->data
        );

        $this->ExecuteSqlQuery($bookShelfSQLQueryBuilder->GetSQLQuery());

        $this->CreateResponse(
            new ResponseCreator(
                ResponseBodyCreatorFactory::CreateRespoonseBody_Correct($this->format),
                new ResponseCodeCreator()
            )
        );
    }

    // override
    function methodPUT()
    {
        if ($this->IsISBNCodeNotSet()) {
            // ISBNコードが設定されていない場合、エラーを返す
            throw new Exception("ISBN code is not set", PRECONDITION_REQUIRED_428);
        }

        // SQLクエリの生成
        $bookShelfSQLQueryBuilder = SqlQueryBuilderFactory::UpdateBookShelf(
            $this->isbn,
            $this->data
        );

        $this->ExecuteSqlQuery($bookShelfSQLQueryBuilder->GetSQLQuery());

        $this->CreateResponse(
            new ResponseCreator(
                ResponseBodyCreatorFactory::CreateRespoonseBody_Correct($this->format),
                new ResponseCodeCreator()
            )
        );
    }

    // override
    function methodDELETE()
    {
        if ($this->IsISBNCodeNotSet()) {
            // ISBNコードが設定されていない場合、エラーを返す
            throw new Exception("ISBN code is not set", PRECONDITION_REQUIRED_428);
        }

        // SQLクエリの生成
        $bookShelfSQLQueryBuilder = SqlQueryBuilderFactory::DeleteBookShelf(
            $this->isbn,
            $this->data
        );

        // SQLクエリの実行
        $this->ExecuteSqlQuery($bookShelfSQLQueryBuilder->GetSQLQuery());

        $this->CreateResponse(
            new ResponseCreator(
                ResponseBodyCreatorFactory::CreateRespoonseBody_Correct($this->format),
                new ResponseCodeCreator()
            )
        );
    }
}
