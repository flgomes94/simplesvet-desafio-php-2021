<?php
$servername = "127.0.0.1:3306";
$username = "root";
$password = "root";
$database = "complicadovet";
$colunasAnimal = array('Id', 'IdCliente', 'Nome', 'Raca', 'Especie', 'HistoricoClinico', 'Nascimento');
$colunasCliente = array('Id', 'Nome', 'Telefone1', 'Telefone2', 'Email');

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}
$queryAnimal =  "SELECT * from Animal";
$arquivoAnimal = fopen('Animal.csv', 'w');

fputcsv($arquivoAnimal, $colunasAnimal);
if ($result = $conn->query($queryAnimal)) {
    while ($row = $result->fetch_array()) {
        $linha = array();
        foreach ($colunasAnimal as $field) {
            array_push($linha, $row[$field] ?? "");
        }
        fputcsv($arquivoAnimal, $linha);
    }
    $result->free();
}
fclose($arquivoAnimal);

$queryCliente =  "SELECT * from Cliente";
$arquivoCliente = fopen('Cliente.csv', 'w');

fputcsv($arquivoCliente, $colunasCliente);
if ($result = $conn->query($queryCliente)) {
    while ($row = $result->fetch_array()) {
        $linha = array();
        foreach ($colunasCliente as $field) {
            array_push($linha, $row[$field] ?? "");
        }
        fputcsv($arquivoCliente, $linha);
    }
    $result->free();
}
fclose($arquivoCliente);

$conn->close();
