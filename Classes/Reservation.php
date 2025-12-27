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

    public function countReservationsByTour($tour_id) {
        $query = "SELECT COUNT(*) as count FROM reservation WHERE tour_id = :tour_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":tour_id", $tour_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['count'];

    }
    public function getReservationsByUser($user_id) {
        $query = "SELECT * FROM tours WHERE id IN (SELECT tour_id FROM reservation WHERE user_id = :user_id) ORDER BY date_heure_debut DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}