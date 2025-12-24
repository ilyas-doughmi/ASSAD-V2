<?php 

Class Habitat{
    private $id;
    private $nom;
    private $description;
    private $image;
    private $typeClimat;
    private $zoneZoo;


    private $pdo;


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getHabitatById($id){
        $query = "SELECT * FROM habitat WHERE id = :habitat_id";
        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->bindParam(":habitat_id",$id);

        $stmt->execute();

        $data = $stmt->fetchAll();

        $this->id = $data["id"];
        $this->nom = $data["nom"];


    }

    public function getAllHabitat(){
        $query = "SELECT * FROM habitat";
        $stmt = $this->pdo->connect()->query($query);
        $stmt->execute();

        $habitat = $stmt->fetchAll();
        $habitat_count = count($habitat);
        return [
            "count" => $habitat_count,
            "habitats" => $habitat
        ];   
    }

    public function createHabitat($nom,$description,$image,$type_climat,$zone_zoo){
        $query = "INSERT INTO habitat (nom, description, image, zone, type_climat) VALUES (:nom,:description,:image,:zone,:climat)";
        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->bindParam(":nom",$nom);
        $stmt->bindParam(":description",$description);
        $stmt->bindParam(":image",$image);
        $stmt->bindParam(":zone",$zone_zoo);
        $stmt->bindParam(":climat",$type_climat);
        $stmt->execute();
    }
    
}