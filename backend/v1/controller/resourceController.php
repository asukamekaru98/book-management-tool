<?php
require_once(__DIR__ . '/../database/database.php');
require_once(__DIR__ . '/../constant/const_statusCode.php');
require_once(__DIR__ . '/../database/SqlController.php');

abstract class resourceController
{

    protected $method;
    protected $isbn;
    protected $format;
    protected $data;

    public function __construct(
        protected DataBaseMySQL $db
    ) {}

    public function handle($method, $isbn, $format, $data)
    {

        $this->method = $method;
        $this->isbn = $isbn;
        $this->format = $format;
        $this->data = $data;

        switch ($method) {
            case 'GET':
                return $this->methodGET();
            case 'POST':
                return $this->methodPOST($isbn, $format, $data);
            case 'PUT':
                return $this->methodPUT($isbn, $format, $data);
            case 'DELETE':
                return $this->methodDELETE($isbn, $format, $data);
            case 'PATCH':
                return $this->methodPATCH($isbn, $format, $data);
        }

        throw new BadMethodCallException("Bad Method");
        // データベース接続を利用したアカウント作成処理
        //return $this->customerReg($data, $this->db);

    }

    public function methodGET()
    {
        http_response_code(METHOD_NOT_ALLOWED_405);
        echo json_encode(["message" => "Method not allowed"]);
        throw new RuntimeException("Methods not supported by this function");
    }

    public function methodPOST()
    {
        http_response_code(METHOD_NOT_ALLOWED_405);
        echo json_encode(["message" => "Method not allowed"]);
        throw new RuntimeException("Methods not supported by this function");
    }

    public function methodPUT()
    {
        http_response_code(METHOD_NOT_ALLOWED_405);
        echo json_encode(["message" => "Method not allowed"]);
        throw new RuntimeException("Methods not supported by this function");
    }

    public function methodDELETE()
    {
        http_response_code(METHOD_NOT_ALLOWED_405);
        echo json_encode(["message" => "Method not allowed"]);
        throw new RuntimeException("Methods not supported by this function");
    }

    public function methodPATCH()
    {
        http_response_code(METHOD_NOT_ALLOWED_405);
        echo json_encode(["message" => "Method not allowed"]);
        throw new RuntimeException("Methods not supported by this function");
    }
}
