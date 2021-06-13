<?php
$servername = "localhost:3306";
$username = "root";
$password = "root";
$database = "complicadovet";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
  die("Erro de conexão: " . $conn->connect_error);
}
$q1 =  "SELECT * from Animal";
$arquivoAnimal = fopen('Animal.csv', 'w');
$arrayAnimal = array('Id','IdCliente','Nome','Raca','Especie','HistoricoClinico','Nascimento');
fputcsv($arquivoAnimal,$arrayAnimal);
if($result = $conn->query($q1)){
    while($row = $result->fetch_array()){
        $linha = array();
        foreach($arrayAnimal as $field){
            array_push($linha, $row[$field]);
        }
        fputcsv($arquivoAnimal, $linha);
    }
    $result->free();
}
$conn->close();
?>