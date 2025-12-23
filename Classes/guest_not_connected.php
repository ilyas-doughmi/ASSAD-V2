<?php 
require_once("User.php");

Class guest_not_connected extends User{

    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
    public function register($email,$password,$fullname,$role){
        $this->email = $email;
        $password = password_hash($password,PASSWORD_DEFAULT);
        $this->password = $password;
        $this->role = $role;
        $this->full_name = $fullname;  
        
    if (!preg_match('/^[^@\s]+@[^@\s]+\.[^@\s]+$/', $email)) {
        $message = "Invalid email format";
        header("location: ../../register.php?message=".$message);
        exit();
    }
    
    $isVisitor = 1;

    if($role == "guide"){
        $isVisitor = 0;
    }

    $query = "INSERT INTO users(full_name,email,password,role,isActive) 
            VALUES(:full_name,:email,:password,:role,:isactive);";
    $stmt = $this->pdo->connect()->prepare($query);
    $stmt->bindParam(":full_name",$this->full_name);
    $stmt->bindParam(":email",$this->email);
    $stmt->bindParam(":password",$this->password);
    $stmt->bindParam(":role",$this->role);
    $stmt->bindValue(":isActive",$isVisitor);
    
    try{    
        $stmt->execute();
    }catch(PDOException $e){
        return $e->getMessage();
    }
    
    }
}