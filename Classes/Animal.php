<?php

Class Animal{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAnimalById($animal_id){
        $query = "SELECT * FROM Animal WHERE id = :animal_id";
        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->bindParam(":animal_id",$animal_id);

        try{
            $stmt->execute();
        }catch(PDOException $e){
            die($e->getMessage());
        }

    }
}