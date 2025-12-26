<?php 

class reservation{
    private $id;
    private $tour_id;
    private $user_id;
    private $reservationDate;
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

    public function getReservationDate() {
        return $this->reservationDate;
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

    public function setReservationDate($reservationDate) {
        $this->reservationDate = $reservationDate;
    }

    public function createReservation(){
        $query = "INSERT INTO reservation(user_id, tour_id) VALUES(:user_id, :tour_id)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ':user_id' => $this->user_id,
            ':tour_id' => $this->tour_id
        ]);
    }
}