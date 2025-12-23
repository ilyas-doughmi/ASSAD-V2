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

}