<?php
namespace Src\controllers;

use Src\gateways\AnimalGateway;

class AnimalController {
    private $requestMethod;
    private $animalGateway;

    public function __construct($db, $requestMethod)
    {
        $this->requestMethod = $requestMethod;
        $this->animalGateway = new AnimalGateway($db);
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->getAll();
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

    private function getAll()
    {
        $result = $this->animalGateway->findAll();
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