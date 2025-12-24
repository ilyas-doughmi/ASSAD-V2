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

    public function getAllAnimals(){
        $query = "SELECT * FROM Animal";
        $stmt = $this->pdo->connect()->query($query);
        $stmt->execute();
        $animals = $stmt->fetchAll();
        $count = count($animals);


        return [
            "count" => $count,
            "animals" => $animals
        ];
    }


    public function createAnimal($nom,$espece,$pays,$habitat_id,$description,$alimentation,$image){
        $query = "INSERT INTO animal (nom, espece, pays_origin, habitat_id, description_courte, alimentation, image, vues) VALUES 
                (:nom,:espece,:pays_origin,:habitat_id,:description,:alimentation,:image, 0)";

        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->bindParam(":nom",$nom);
        $stmt->bindParam(":espece",$espece);
        $stmt->bindParam(":pays_origin",$pays);
        $stmt->bindParam(":habitat_id",$habitat_id);
        $stmt->bindParam("description",$description);
        $stmt->bindParam(":alimentation",$alimentation);
        $stmt->bindParam(":image",$image);

        $stmt->execute();
    }

    public function deleteAnimal($id){
        $query = "DELETE FROM animal WHERE id = :animal_id";
        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->bindParam(":animal_id",$id);

        $stmt->execute();
    }
}