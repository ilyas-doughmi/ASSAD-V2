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


    public function signin($email, $password)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location: ../../login.php?message=Invalid email format");
        exit();
    }

    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $this->pdo->connect()->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        header("location: ../../login.php?message=account not found");
        exit();
    }

    if (!password_verify($password, $user["password"])) {
        header("location: ../../login.php?message=password problem");
        exit();
    }

    if ($user["isBanned"] == 1) {
        header("location: ../../index.php?message=account_banned");
        exit();
    }

    session_start();
    $_SESSION["id"] = $user["id"];
    $_SESSION["role"] = $user["role"];
    $_SESSION["isActive"] = $user["isActive"];

    switch ($user["role"]) {
        case 'admin':
            header("location: ../../pages/admin/admin_dashboard.php");
            break;
        case 'guide':
            header("location: ../../pages/guide/guide_dashboard.php");
            break;
        default:
            header("location: ../../index.php");
    }
    exit();
}

}