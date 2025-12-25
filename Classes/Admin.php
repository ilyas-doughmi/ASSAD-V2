<?php

Class Admin extends User{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }



    public function approveGuide($guide_id){
        $query = "UPDATE users SET isActive = 1 WHERE id = :guide_id";
        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->bindParam(":guide_id",$guide_id);
        $stmt->execute();
    }

    public function rejectGuide($guide_id){
        $query = "UPDATE users SET isBanned = 1 , isActive = 1 WHERE id = :guide_id";
        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->bindParam(":guide_id",$guide_id);
        $stmt->execute();
    }
    public function banAccount($guide_id){
        $query = "UPDATE users SET isBanned = 1 , isActive = 1 WHERE id = :guide_id";
        $stmt = $this->pdo->connect()->prepare($query);
        $stmt->bindParam(":guide_id",$guide_id);
        $stmt->execute();
    }
}