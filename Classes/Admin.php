<?php

Class Admin extends User{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllUsers(){
        $query = "SELECT * FROM users";
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