<?php
$servername = "localhost:3306";
$username = "root";
$password = "root";
$database = "complicadovet";
$colunasAnimal = array('Id','IdCliente','Nome','Raca','Especie','HistoricoClinico','Nascimento');

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
  die("Erro de conexão: " . $conn->connect_error);
}
$queryAnimal =  "SELECT * from Animal";
$arquivoAnimal = fopen('Animal.csv', 'w');

fputcsv($arquivoAnimal,$colunasAnimal);
if($result = $conn->query($queryAnimal)){
    while($row = $result->fetch_array()){
        $linha = array();
        foreach($colunasAnimal as $field){
            array_push($linha, $row[$field]);
        }
        fputcsv($arquivoAnimal, $linha);
    }
    $result->free();
}
$conn->close();
?>