<?php
namespace Src\controllers;

use Src\gateways\ContatoGateway;

class ContatoController {
    private $requestMethod;
    private $contatoGateway;

    public function __construct($db, $requestMethod,$dados)
    {
        $this->requestMethod = $requestMethod;
        $this->dados = $dados;
        
        $this->contatoGateway = new ContatoGateway($db);
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'POST':
                $response = $this->criarContatoRequest();
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

    private function criarContatoRequest()
    {
        $this->contatoGateway->insert($this->dados);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = null;
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
    
    
}