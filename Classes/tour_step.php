<?php

class tour_step
{
    private $pdo;
    private $id;
    private $titre_etape;
    private $description_etape;
    private $order_etape;
    private $tour_id;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitreEtape()
    {
        return $this->titre_etape;
    }

    public function setTitreEtape($titre_etape)
    {
        $this->titre_etape = $titre_etape;
    }

    public function getDescriptionEtape()
    {
        return $this->description_etape;
    }

    public function setDescriptionEtape($description_etape)
    {
        $this->description_etape = $description_etape;
    }

    public function getOrderEtape()
    {
        return $this->order_etape;
    }

    public function setOrderEtape($order_etape)
    {
        $this->order_etape = $order_etape;
    }

    public function getTourId()
    {
        return $this->tour_id;
    }

    public function setTourId($tour_id)
    {
        $this->tour_id = $tour_id;
    }


    public function addStep(){
        $query = "INSERT INTO tour_step(titre_etape,description_etape,order_etape,tour_id)
        VALUES(:titre, :description, :order, :tour_id)";
        $stmt = $this->pdo->prepare($query);
        
        $stmt->execute([
            ':titre' => $this->titre_etape,
            ':description' => $this->description_etape,
            ':order' => $this->order_etape,
            ':tour_id' => $this->tour_id
        ]);
    }

    public function editStep($id){
        $query = "UPDATE tour_step SET titre_etape = :titre, description_etape = :description, order_etape = :order, tour_id = :tour_id WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':titre' => $this->titre_etape,
            ':description' => $this->description_etape,
            ':order' => $this->order_etape,
            ':tour_id' => $this->tour_id,
            ':id' => $id
        ]);
    }

    public function deleteStep($id){
        $query = "DELETE FROM tour_step WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
    }

    public function getStepInfo($id){
        $query = "SELECT * FROM tour_step WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getStepsByTourId($tour_id){
        $query = "SELECT * FROM tour_step WHERE tour_id = :tour_id ORDER BY order_etape ASC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':tour_id' => $tour_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
