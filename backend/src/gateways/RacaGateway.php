<?php
namespace Src\gateways;

class RacaGateway {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        $statement = "
            SELECT 
                id, especie_id,nome
            FROM
                racas;
        ";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return array("data" => $result, "headers" => array("id","especie_id","nome"));
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function insert(Array $entrada)
    {
        $statement = "
            INSERT into racas
                (especie_id,nome)
            VALUES
                (:especie_id,:nome)
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'especie_id'=>$entrada['especie_id'],
                'nome'=>$entrada['nome'],
            ));
            $racaInseridaId = $this->racaPorId($this->db->lastInsertId());
            return $racaInseridaId;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function racaPorId($raca_id)
    {
        $statement = "
            SELECT 
                id,especie_id,nome 
            FROM 
                racas
            WHERE
                id = ?
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($raca_id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result[0]??null;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function procurarPorNome($raca_nome)
    {
        $statement = "
            SELECT 
                id,especie_id,nome 
            FROM 
                racas
            WHERE
                nome = ?
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($raca_nome));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result[0]??null;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}