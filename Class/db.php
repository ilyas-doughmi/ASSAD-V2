<?php

Class db{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "assad";

    public function connect(){
         try{
            $pdo = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name,$this->username,$this->password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            return $pdo;

        }catch(PDOException $e){
            die($e->getMessage());
        }
}
}