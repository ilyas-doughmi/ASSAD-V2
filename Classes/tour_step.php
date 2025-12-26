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

    public function editStep(){

    }

    public function deleteStep($id){

    }

    public function getStepInfo($id){

    }

}
