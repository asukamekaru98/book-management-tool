<?php

use SqlQueryBuilder\SqlQueryBuilderFactory;
use ReturnResponse\ReturnResponse;
use ResponseCreator\ResponseCreator;
use ResponseBodyCreator\ResponseBodyCreatorFactory;

require_once(__DIR__ . '/resourceController.php');
require_once(__DIR__ . '/../sql/sqlManager.php');
require_once(__DIR__ . '/../sqlQueryBuilder/sqlQueryBuilderFactory.php');
require_once __DIR__ . '/../returnResponse/returnResponse.php';
require_once __DIR__ . '/../responseCreator/responseCreator.php';
require_once __DIR__ . '/../responseCreator/responseBodyCreator/responseBodyCreator.php';
require_once __DIR__ . '/../responseCreator/responseBodyCreator/responseBodyCreatorFactory.php';

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

        // SQLクエリの実行
        $this->sqlManager->ExecuteSqlQuery($bookShelfSQLQueryBuilder->GetSQLQuery());

        // SQLクエリの実行結果を確認
        $responseCode = $this->sqlManager->GetHttpResponseCode();
        if ($responseCode >= MULTIPLE_CHOICES_300) {
            throw new Exception("Failed to insert book shelf", $responseCode);
        }

        $responseCreator = new ResponseCreator(
            ResponseBodyCreatorFactory::CreateRespoonseBody($this->format)
        );

        $responseCreator->CreateResponse(
            $this->sqlManager->GetHttpResponseCode(),
            $this->sqlManager->GetResponseBody()
        );

        ReturnResponse::returnHttpResponse($responseCreator);
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

        // SQLクエリの実行
        $this->sqlManager->ExecuteSqlQuery($bookShelfSQLQueryBuilder->GetSQLQuery());

        // SQLクエリの実行結果を確認
        $responseCode = $this->sqlManager->GetHttpResponseCode();
        if ($responseCode >= MULTIPLE_CHOICES_300) {
            throw new Exception("Failed to insert book shelf", $responseCode);
        }

        $responseCreator = new ResponseCreator(
            ResponseBodyCreatorFactory::CreateRespoonseBody($this->format)
        );

        $responseCreator->CreateResponse(
            $this->sqlManager->GetHttpResponseCode(),
            $this->sqlManager->GetResponseBody()
        );

        ReturnResponse::returnHttpResponse($responseCreator);
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

        // SQLクエリの実行
        $this->sqlManager->ExecuteSqlQuery($bookShelfSQLQueryBuilder->GetSQLQuery());

        // SQLクエリの実行結果を確認
        $responseCode = $this->sqlManager->GetHttpResponseCode();
        if ($responseCode >= MULTIPLE_CHOICES_300) {
            throw new Exception("Failed to insert book shelf", $responseCode);
        }

        $responseCreator = new ResponseCreator(
            ResponseBodyCreatorFactory::CreateRespoonseBody($this->format)
        );

        $responseCreator->CreateResponse(
            $this->sqlManager->GetHttpResponseCode(),
            $this->sqlManager->GetResponseBody()
        );

        // レスポンスを返す
        ReturnResponse::returnHttpResponse($responseCreator);
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
        $this->sqlManager->ExecuteSqlQuery($bookShelfSQLQueryBuilder->GetSQLQuery());

        // SQLクエリの実行結果を確認
        $responseCode = $this->sqlManager->GetHttpResponseCode();
        if ($responseCode >= MULTIPLE_CHOICES_300) {
            throw new Exception("Failed to insert book shelf", $responseCode);
        }

        $responseCreator = new ResponseCreator(
            ResponseBodyCreatorFactory::CreateRespoonseBody($this->format)
        );

        $responseCreator->CreateResponse(
            $this->sqlManager->GetHttpResponseCode(),
            $this->sqlManager->GetResponseBody()
        );

        // レスポンスを返す
        ReturnResponse::returnHttpResponse($responseCreator);
    }
}
