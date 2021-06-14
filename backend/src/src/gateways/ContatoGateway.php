<?php
namespace Src\gateways;

class ContatoGateway {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
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