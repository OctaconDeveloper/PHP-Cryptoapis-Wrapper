<?php
namespace PhpCryptoApis;
use GuzzleHttp\Client;
use PhpCryptoApis\Response;

class Base {

    protected $apiKey;

    function __construct(String $apiKey) 
    {
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => 'https://api.cryptoapis.io/v1/bc/',
            'headers' => [
                'Content-Type' => 'application/json',
                'X-API-Key' => $this->apiKey
                ]
        ]);
      }

    public function postRequest(String $url, Array $payload = [])
    {   
        try{
            $response = $this->client->post($url, $payload);
            $status = $response->getStatusCode(); 
            $data =  $response->getBody()->getContents();
           return (new Response($status,$data))->customResponse();
        }catch(\Exception $err){
            return (new Response($err->getCode()))->defaultResponse();
   
        }
    }

    public function getRequest(String $url, Array $payload = [])
    {   
        try{
            $response = $this->client->get($url, $payload);
            $status = $response->getStatusCode(); 
            $data =  $response->getBody()->getContents();
           return (new Response($status,$data))->customResponse();
        }catch(\Exception $err){
            return (new Response($err->getCode()))->defaultResponse();
   
        }
    }

}