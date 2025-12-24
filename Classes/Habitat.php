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

        return $stmt->fetchAll();
    }

    public function getAllHabitat(){
        $query = "SELECT * FROM habitat";
        $stmt = $this->pdo->connect()->query($query);
        $stmt->execute();
        return $stmt->fetchAll();       
    }
    
}