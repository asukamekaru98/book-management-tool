<?php
require_once(__DIR__ . '/../database/database.php');
require_once(__DIR__ . '/../constant/const_statusCode.php');
require_once(__DIR__ . '/../database/SqlController.php');

abstract class resourceController
{

    public function __construct(protected DataBaseMySQL $db) {}

    public function handle($method, $isbn, $data)
    {
        switch ($method) {
            case 'GET':
                return $this->methodGET($isbn, $data);
            case 'POST':
                return $this->methodPOST($isbn, $data);
            case 'PUT':
                return $this->methodPUT($isbn, $data);
            case 'DELETE':
                return $this->methodDELETE($isbn, $data);
            case 'PATCH':
                return $this->methodPATCH($isbn, $data);
        }

        throw new BadMethodCallException("Bad Method");
        // データベース接続を利用したアカウント作成処理
        //return $this->customerReg($data, $this->db);

    }

    public function methodGET($isbn, $data)
    {
        http_response_code(METHOD_NOT_ALLOWED_405);
        echo json_encode(["message" => "Method not allowed"]);
        throw new RuntimeException("Methods not supported by this function");
    }

    public function methodPOST($isbn, $data)
    {
        http_response_code(METHOD_NOT_ALLOWED_405);
        echo json_encode(["message" => "Method not allowed"]);
        throw new RuntimeException("Methods not supported by this function");
    }

    public function methodPUT($isbn, $data)
    {
        http_response_code(METHOD_NOT_ALLOWED_405);
        echo json_encode(["message" => "Method not allowed"]);
        throw new RuntimeException("Methods not supported by this function");
    }

    public function methodDELETE($isbn, $data)
    {
        http_response_code(METHOD_NOT_ALLOWED_405);
        echo json_encode(["message" => "Method not allowed"]);
        throw new RuntimeException("Methods not supported by this function");
    }

    public function methodPATCH($isbn, $data)
    {
        http_response_code(METHOD_NOT_ALLOWED_405);
        echo json_encode(["message" => "Method not allowed"]);
        throw new RuntimeException("Methods not supported by this function");
    }
}
