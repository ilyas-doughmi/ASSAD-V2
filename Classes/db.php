<?php

class db
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "assad";

    private static $instance = null;

    public function connect()
    {
        if (self::$instance == null) {
            try {
                self::$instance = new PDO(
                    "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                    $this->username,
                    $this->password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
                
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        else{
            return self::$instance;
        }
    }
}
