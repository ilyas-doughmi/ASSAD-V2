<?php 

require_once("../../Classes/db.php");
require_once("../../Classes/User.php");


$pdo = new db;


$guest = new User($pdo);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Sanitize inputs
    $email = htmlspecialchars(trim($_POST["email"]), ENT_QUOTES, 'UTF-8');
    $nom = htmlspecialchars(trim($_POST["nom"]), ENT_QUOTES, 'UTF-8');
    $password = $_POST["password"]; // Don't trim password
    $role = htmlspecialchars(trim($_POST["role"]), ENT_QUOTES, 'UTF-8');
    
    // Validate role
    if (!in_array($role, ['visitor', 'guide'])) {
        header("location: ../../register.php?message=Invalid role");
        exit();
    }
    
    $guest->setEmail($email);
    $guest->setFullName($nom);
    $guest->setPassword($password);
    $guest->setRole($role);
    
    if($guest->register()){
        header("location: ../../login.php?message=register success");
        exit();
    }
    else{
        header("location: ../../register.php?message=Registration failed. Check email format, name (letters only), and password (8+ chars, 1 uppercase, 1 lowercase, 1 number)");
        exit();
    }
}