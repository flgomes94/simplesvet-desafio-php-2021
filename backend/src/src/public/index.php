<?php
require "../../bootstrap.php";

use Src\gateways\AnimalGateway;
use Src\gateways\ContatoGateway;
use Src\gateways\EspecieGateway;
use Src\gateways\PessoaGateway;
use Src\gateways\RacaGateway;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$requestMethod = $_SERVER["REQUEST_METHOD"];

if($uri[1] == 'upload'){
    $fileClientes = $_FILES["clientes"];
    $fileAnimais = $_FILES["animais"];
    if (($h = fopen($fileClientes['tmp_name'], "r")) !== FALSE) {
        $header = fgetcsv($h, 0, ",");
        while (($data = fgetcsv($h, 0, ",")) !== FALSE){		
            $id = $data[0];
            $nome = $data[1];
            $telefone1 = $data[2];
            $telefone2 = $data[3];
            $email = $data[4];
            $gatewayPessoa = new PessoaGateway($dbConnection);
            $pessoaInserida = $gatewayPessoa->insert(array("id"=>$id,"nome"=>$nome));
            $gatewayContato = new ContatoGateway($dbConnection);
            $gatewayContato->insert(array("pessoa_id" => $pessoaInserida['id'], "tipo" =>"fixo","contato"=>$telefone1));
            $gatewayContato->insert(array("pessoa_id" => $pessoaInserida['id'], "tipo" =>"fixo","contato"=>$telefone2));
            $gatewayContato->insert(array("pessoa_id" => $pessoaInserida['id'], "tipo" =>"email","contato"=>$email));
        }
        fclose($h);
    }
    if (($h = fopen($fileAnimais['tmp_name'], "r")) !== FALSE) {
        $header = fgetcsv($h, 0, ",");
        while (($data = fgetcsv($h, 0, ",")) !== FALSE){		
            $id = $data[0];
            $idCliente = $data[1];
            $nome = $data[2];
            $raca = $data[3];
            $especie = $data[4];
            $historico = $data[5];
            $nascimento = $data[6];
            $gatewayEspecie = new EspecieGateway($dbConnection);
            $existeEspecie = $gatewayEspecie->procurarPorNome($especie);
            if(!$existeEspecie){
                $existeEspecie = $gatewayEspecie->insert(array("nome" => $especie));
            }
            $gatewayRaca = new RacaGateway($dbConnection);
            $existeRaca = $gatewayRaca->procurarPorNome($raca);
            if(!$existeRaca){
                $existeRaca = $gatewayRaca->insert(array("nome" => $raca, "especie_id" => $existeEspecie['id']));
            }
            $gatewayAnimal = new AnimalGateway($dbConnection);
            $gatewayAnimal->insert(array("pessoa_id" => $idCliente,"especie_id" => $existeEspecie['id'],"raca_id" => $existeRaca['id'], "nome"=> $nome,  "nascimento"=> $nascimento));


        }
        fclose($h);
    }
}
else{
    header("HTTP/1.1 404 Not Found");
    exit();
}
