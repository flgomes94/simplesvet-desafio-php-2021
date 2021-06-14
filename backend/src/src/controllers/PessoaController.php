<?php
namespace Src\controllers;

use Src\gateways\PessoaGateway;

class PessoaController {
    private $requestMethod;
    private $pessoaGateway;
    private $data;


    public function __construct($db, $requestMethod, $data=null)
    {
        $this->requestMethod = $requestMethod;
        $this->data = $data;
        $this->pessoaGateway = new PessoaGateway($db);
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->getAllUsers();
                break;
            case 'POST':
                $response = $this->createUser();
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function getAllUsers()
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