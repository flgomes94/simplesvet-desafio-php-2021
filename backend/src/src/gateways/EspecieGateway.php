<?php
namespace Src\gateways;

class EspecieGateway {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        $statement = "
            SELECT 
                id, nome
            FROM
                especies;
        ";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return array("data" => $result, "headers" => array("id","nome"));
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function insert(Array $entrada)
    {
        $statement = "
            INSERT into especies
                (nome)
            VALUES
                (:nome)
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'nome'=>$entrada['nome'],
            ));
            $especieInserida = $this->especiePorId($this->db->lastInsertId());
            return $especieInserida;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function especiePorId($especie_id)
    {
        $statement = "
            SELECT 
                id,nome 
            FROM 
                especies
            WHERE
                id = ?
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($especie_id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result[0]??null;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function procurarPorNome($especie_nome)
    {
        $statement = "
            SELECT 
                id,nome 
            FROM 
                especies
            WHERE
                nome = ?
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($especie_nome));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result[0]??null;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}