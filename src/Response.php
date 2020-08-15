<?php
namespace PhpCryptoApis;

class Response {

    protected $data;
    protected $status;

    protected static $errorLog = array(
        401 => "Invalid or missing API key",
    );


    public function __construct($status = null, $data = [])
    {
        $this->status = $status;
        $this->data = json_decode($data)->payload;
    }

    public function customResponse()
    {
        $response = [
            'status' => $this->status,
            'data' => $this->data
        ];

        header('Content-Type: application/json');
        return json_encode($response);
    }

    public function defaultResponse()
    {
        $response = [
            'status' => $this->status,
            'data' => self::$errorLog[$this->status]
        ];

        header('Content-Type: application/json');
        return json_encode($response);
    }

    
}