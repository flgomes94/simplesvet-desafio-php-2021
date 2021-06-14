<?php
namespace Src\gateways;

class AnimalGateway {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        $statement = "
            SELECT 
                id, pessoa_id,especie_id,raca_id,nome,nascimento
            FROM
                animais;
        ";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return array("data" => $result, "headers" => array("id","pessoa_id","especie_id", "raca_id","nome","nascimento"));
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function insert(Array $entrada)
    {
        $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $statement = "
            INSERT into animais
                (pessoa_id,especie_id,raca_id,nome,nascimento)
            VALUES
                (:pessoa_id,:especie_id,:raca_id,:nome,:nascimento)
        ";

        try {
            $statement = $this->db->prepare($statement);
            $data= null;
            if($entrada['nascimento']){
                $data = implode("-",array_reverse(explode("/",$entrada['nascimento'])));
            }
            $statement->execute(array(
                'pessoa_id'=>$entrada['pessoa_id'],
                'especie_id'=>$entrada['especie_id'],
                'raca_id'=>$entrada['raca_id'],
                'nome'=>$entrada['nome'],
                'nascimento' => $data??NULL,
            ));
            $racaInseridaId = $this->animalPorId($this->db->lastInsertId());
            return $racaInseridaId;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function animalPorId($animal_id)
    {
        $statement = "
            SELECT 
                pessoa_id,especie_id,raca_id,nome,nascimento
            FROM 
                animais
            WHERE
                id = ?
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($animal_id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result[0]??null;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}