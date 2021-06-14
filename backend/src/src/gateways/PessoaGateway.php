<?php
namespace Src\gateways;

class PessoaGateway {

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
                pessoas;
        ";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function insert(Array $entrada)
    {
        $statement = "
            INSERT into pessoas
                (id,nome)
            VALUES
                (:id,:nome)
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'id'=>$entrada['id'],
                'nome'=>$entrada['nome'],
            ));
            $pessoaInserida = $this->pessoaPorId($this->db->lastInsertId());
            return $pessoaInserida;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function pessoaPorId($pessoa_id)
    {
        $statement = "
            SELECT 
                id,nome 
            FROM 
                pessoas
            WHERE
                id = ?
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($pessoa_id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            print_r($result[0]);
            return $result[0]??null;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}