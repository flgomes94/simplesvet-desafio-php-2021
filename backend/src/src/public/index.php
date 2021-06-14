<?php
require "../../bootstrap.php";

use Src\controllers\AnimalController;
use Src\controllers\ContatoController;
use Src\controllers\EspecieController;
use Src\controllers\PessoaController;
use Src\controllers\RacaController;
use Src\gateways\AnimalGateway;
use Src\gateways\ContatoGateway;
use Src\gateways\EspecieGateway;
use Src\gateways\PessoaGateway;
use Src\gateways\RacaGateway;
use Src\helpers\Validators;

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
            $validators = new Validators();
            if($telefone1){
                $telefone_formatado_1 = $validators->telefone($telefone1);
                if($telefone_formatado_1["valid"]){
                    $gatewayContato->insert(array("pessoa_id" => $pessoaInserida['id'], "tipo" =>$telefone_formatado_1["tipo"],"contato"=>$telefone_formatado_1["telefone"]));
                }
            }
            if($telefone2){
                $telefone_formatado_2 = $validators->telefone($telefone2);
                if($telefone_formatado_2["valid"]){
                    $gatewayContato->insert(array("pessoa_id" => $pessoaInserida['id'], "tipo" =>$telefone_formatado_2["tipo"],"contato"=>$telefone_formatado_2["telefone"]));
                }
            }
            if($validators->email($email)){
                $gatewayContato->insert(array("pessoa_id" => $pessoaInserida['id'], "tipo" =>"email","contato"=>$email));
            }
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
if($uri[1] == 'pessoas')
{
    $pessoaController = new PessoaController($dbConnection, $requestMethod);
    return $pessoaController->processRequest();
} 
else if($uri[1] == 'contatos')
{
    $contatoController = new ContatoController($dbConnection, $requestMethod);
    return $contatoController->processRequest();
}
else if($uri[1] == 'especies')
{
    $especieController = new EspecieController($dbConnection, $requestMethod);
    return $especieController->processRequest();
}

else if($uri[1] == 'racas')
{
    $racaController = new RacaController($dbConnection, $requestMethod);
    return $racaController->processRequest();
}

else if($uri[1] == 'animais')
{
    $animalController = new AnimalController($dbConnection, $requestMethod);
    return $animalController->processRequest();
}

else{
    header("HTTP/1.1 404 Not Found");
    exit();
}
