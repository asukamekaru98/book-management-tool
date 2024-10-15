<?php
require_once(__DIR__ . '/../database/database.php');
require_once(__DIR__ . '/../constant/const_statusCode.php');
require_once(__DIR__ . '/../sql/SqlManager.php');

abstract class resourceController
{

    protected $method;
    protected $isbn;
    protected $format;
    protected $data;
    protected $industry_important;
    protected $work_important;
    protected $user_important;
    protected $priority;
    protected $purchased_flag;
    protected $viewed_flag;

    public function __construct(
        protected DataBaseMySQL $db
    ) {}

    public function handle($method, $isbn, $format, $data)
    {

        $this->method = $method;
        $this->isbn = $isbn;
        $this->format = $format;
        $this->data = $data;
        $this->industry_important = $data['industry_important'] ?? 0;
        $this->work_important = $data['work_important'] ?? 0;
        $this->user_important = $data['user_important'] ?? 0;
        $this->priority = $data['priority'] ?? 0;
        $this->purchased_flag = $data['purchased_flag'] ?? 0;
        $this->viewed_flag = $data['viewed_flag'] ?? 0;
        /*
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
*/
        // デバッグ用
        switch ($method) {
            case 'GET':
                //return $this->methodGET();
            case 'POST':
                return $this->methodPOST();
            case 'PUT':
                return $this->methodPUT();
            case 'DELETE':
                return $this->methodDELETE();
            case 'PATCH':
                return $this->methodPATCH();
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
