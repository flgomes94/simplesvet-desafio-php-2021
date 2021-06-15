<?php
namespace Src\gateways;

class ContatoGateway {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        $statement = "
            SELECT 
                id, pessoa_id,tipo,contato
            FROM
                contatos;
        ";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return array("data" => $result, "headers" => array("id","pessoa_id", "tipo", "contato"));
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function insert(Array $entrada)
    {
        $statement = "
            INSERT into contatos
                (pessoa_id,tipo,contato)
            VALUES
                (:pessoa_id,:tipo,:contato)


        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'pessoa_id'=>$entrada['pessoa_id'],
                'tipo'=>$entrada['tipo'],
                'contato'=>$entrada['contato'],
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}