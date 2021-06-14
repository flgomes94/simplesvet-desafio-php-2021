<?php
namespace Src\controllers;

use Src\gateways\PessoaGateway;

class PessoaController {
    private $requestMethod;
    private $pessoaGateway;


    public function __construct($db, $requestMethod)
    {
        $this->requestMethod = $requestMethod;
        $this->pessoaGateway = new PessoaGateway($db);
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->getAllPessoas();
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getAllPessoas()
    {
        $result = $this->pessoaGateway->findAll();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function createUser()
    {
        $result = $this->pessoaGateway->findAll();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
    
    
}