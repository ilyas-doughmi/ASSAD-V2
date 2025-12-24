<?php

Class Animal{
    private $pdo;

    private $id;
    private $nom;
    private $espece;
    private $image;
    private $description;
    private $alimentation;
    private $paysOrigin;
    private $habitat_id;
    private $vues;




    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }


    public function getAnimalById($animal_id){
       $query = "SELECT * FROM animal WHERE id = :id";
        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->bindParam(":id",$animal_id);
        $stmt->execute();

        $animal = $stmt->fetch();

        if (!$animal) {
            return false;
        }

        $this->id = $animal["id"];
        $this->nom = $animal["nom"];
        $this->espece = $animal["espece"];
        $this->paysOrigin = $animal["pays_origin"];
        $this->habitat_id = $animal["habitat_id"];
        $this->description = $animal["description_courte"];
        $this->alimentation = $animal["alimentation"];
        $this->image = $animal["image"];
        $this->vues = $animal["vues"];

        return true;

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

    public function editAnimal($nom,$espece,$pays,$habitat_id,$description,$alimentation,$image,$id){

        $this->getAnimalById($id);

        $query = "UPDATE animal 
        SET nom = :nom, espece = :espece, pays_origin = :pays, habitat_id = :habitat_id, description_courte = :description, alimentation = :alimentation, image = :image 
        WHERE id = :animal_id";

        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->bindParam(":nom",$nom);
        $stmt->bindParam(":espece",$espece);
        $stmt->bindParam(":pays",$pays);
        $stmt->bindParam(":habitat_id",$habitat_id);
        $stmt->bindParam(":description",$description);
        $stmt->bindParam(":alimentation",$alimentation);
        $stmt->bindParam(":image",$image);
        $stmt->bindParam(":animal_id",$id);

        $stmt->execute();
    }
}