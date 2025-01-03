<?php
require_once(__DIR__ . '/../database/database.php');
require_once(__DIR__ . '/../constant/const_statusCode.php');
require_once(__DIR__ . '/../sql/SqlManager.php');
require_once __DIR__ . '/../returnResponse/returnResponse.php';
require_once(__DIR__ . '/../validator/isbnValidator.php');

use SqlQueryBuilder\SqlQueryBuilderFactory;
use SqlManager\SqlManager;
use DataBase\DataBaseMySQL;
use Interfaces\I_ResponseCreator;
use ReturnResponse\ReturnResponse;
use validator\IsbnValidator;

abstract class resourceController
{

    protected $method;
    protected $isbn;
    protected $format;
    protected $viewed_flag;
    protected array $data;

    protected SqlManager    $sqlManager;
    protected bool $bIsISBNDuplicate;

    public function __construct(
        protected DataBaseMySQL $db
    ) {}

    public function handle($method, $isbn, $format, $viewed_flag, array $data)
    {

        $this->method = $method;
        $this->isbn = $isbn;
        $this->format = $format;
        $this->viewed_flag = $viewed_flag;
        $this->data = $data;

        $this->sqlManager = new SqlManager($this->db);

        // ISBNが登録されていなければ登録する
        $this->RegisterBookInfoByIsbn();


        switch ($method) {
            case 'GET':
                return $this->methodGET();
            case 'POST':
                return $this->methodPOST();
            case 'PUT':
                return $this->methodPUT();
            case 'DELETE':
                return $this->methodDELETE();
            case 'PATCH':
                return $this->methodPATCH();
        }

        throw new BadMethodCallException("Bad Method", METHOD_NOT_ALLOWED_405);
    }


    public function methodGET()
    {
        ### もしこのメソッドをサポートする場合、継承先でオーバーライドする ###

        throw new RuntimeException("Methods not supported by this function", METHOD_NOT_ALLOWED_405);
    }

    public function methodPOST()
    {
        ### もしこのメソッドをサポートする場合、継承先でオーバーライドする ###

        throw new RuntimeException("Methods not supported by this function", METHOD_NOT_ALLOWED_405);
    }

    public function methodPUT()
    {
        ### もしこのメソッドをサポートする場合、継承先でオーバーライドする ###

        throw new RuntimeException("Methods not supported by this function", METHOD_NOT_ALLOWED_405);
    }

    public function methodDELETE()
    {
        ### もしこのメソッドをサポートする場合、継承先でオーバーライドする ###

        throw new RuntimeException("Methods not supported by this function", METHOD_NOT_ALLOWED_405);
    }

    public function methodPATCH()
    {
        ### もしこのメソッドをサポートする場合、継承先でオーバーライドする ###

        throw new RuntimeException("Methods not supported by this function", METHOD_NOT_ALLOWED_405);
    }

    /**
     * もしISBNが登録されていなければ、登録を行う
     * ISBNが登録されている場合は何もしない
     */
    private function RegisterBookInfoByIsbn(): void
    {
        if ($this->IsISBNCodeNotSet()) {
            // ISBNコードが設定されていない場合は何もしない
            return;
        }

        $isbnValidator = new IsbnValidator($this->sqlManager);

        $isDuplicate = $isbnValidator->IsIsbnCodeDuplicate(
            SqlQueryBuilderFactory::IsIsbnCodeDuplicate(
                $this->isbn,
                $this->data
            )
        );

        // ISBNコードが重複している場合は何もしない
        if (!$isDuplicate) {
            $bookInfoSQLQuery = SqlQueryBuilderFactory::InsertBookInfo(
                $this->isbn,
                $this->data
            );

            try {
                $this->sqlManager->ExecuteSqlQuery($bookInfoSQLQuery->GetSQLQuery());
            } catch (Exception $e) {
                throw new Exception($e->getMessage(), (int)$e->getCode());
            }
        }
    }

    /**
     * ISBNコードが設定されているか確認する
     */
    protected function IsISBNCodeNotSet(): bool
    {
        return $this->isbn === null;
    }

    protected function ExecuteSqlQuery(string $sqlQuery): void
    {

        try {
            $this->sqlManager->ExecuteSqlQuery($sqlQuery);
            $this->CheckResponseCode();
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), (int)$e->getCode());
        }
    }

    private function CheckResponseCode(): void
    {
        $responseCode = $this->sqlManager->GetHttpResponseCode();
        if ($responseCode >= MULTIPLE_CHOICES_300) {
            throw new Exception("Failed to insert book shelf", $responseCode);
        }
    }

    protected function CreateResponse(I_ResponseCreator $responseCreator): void
    {
        $responseCreator->CreateResponse(
            $this->sqlManager->GetHttpResponseCode(),
            $this->sqlManager->GetResponseBody()
        );

        ReturnResponse::returnHttpResponse($responseCreator);
    }
}
