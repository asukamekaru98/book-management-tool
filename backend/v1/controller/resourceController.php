<?php
require_once(__DIR__ . '/../database/database.php');

class resourceController
{
    /* protected $db;

    public function __construct(DataBaseMySQL $db)
    {
        $this->db = $db;
    }
*/
    public function handle($method, $isbn, $data)
    {
        switch ($method) {
            case 'GET':
                $this->methodGET($isbn, $data);
                break;

            case 'POST':
                $this->methodPOST($isbn, $data);
                break;

            case 'PUT':
                $this->methodPUT($isbn, $data);
                break;

            case 'DELETE':
                $this->methodDELETE($isbn, $data);
                break;

            case 'PATCH':
                $this->methodPATCH($isbn, $data);
                break;
        }
        // データベース接続を利用したアカウント作成処理
        //return $this->customerReg($data, $this->db);
    }

    public function methodGET($isbn, $data)
    {
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
    }

    public function methodPOST($isbn, $data)
    {
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
    }

    public function methodPUT($isbn, $data)
    {
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
    }

    public function methodDELETE($isbn, $data)
    {
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
    }

    public function methodPATCH($isbn, $data)
    {
        http_response_code(405);
        echo json_encode(["message" => "Method not allowed"]);
    }
}
