<?php

Class Admin extends User{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllUsers($cond){
        $condition = "";
        switch($cond){
            case "all": $condition = "";break;
            case "guides_ver": $condition = "WHERE isActive = 0 AND role = 'guide'";break;
            default : echo "nothing";break;
        }
        $query = "SELECT * FROM users $condition";
        $stmt = $this->pdo->connect()->query($query);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $count = count($users);
        
        return[
            'count' => $count,
            'users' => $users
        ];
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
}