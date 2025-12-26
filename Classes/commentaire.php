<?php

class commentaire{
    private $id;
    private $tour_id;
    private $user_id;
    private $texte;
    private $note;
    private $dateCommentaire;
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTourId() {
        return $this->tour_id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getTexte() {
        return $this->texte;
    }

    public function getNote() {
        return $this->note;
    }

    public function getDateCommentaire() {
        return $this->dateCommentaire;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setTourId($tour_id) {
        $this->tour_id = $tour_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    public function setTexte($texte) {
        $this->texte = $texte;
    }

    public function setNote($note) {
        $this->note = $note;
    }

    public function setDateCommentaire($dateCommentaire) {
        $this->dateCommentaire = $dateCommentaire;
    }

    public function addCommentaire(){
        $query = "INSERT INTO Comments (tour_id, user_id, texte, note, date_commentaire) VALUES (:tour_id, :user_id, :texte, :note, NOW())";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':tour_id' => $this->tour_id,
            ':user_id' => $this->user_id,
            ':texte' => $this->texte,
            ':note' => $this->note
        ]);
    }
}