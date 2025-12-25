<?php 

require_once("../../Classes/db.php");
require_once("../../Classes/User.php");


$pdo = new db;


$guest = new User($pdo);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $guest->setEmail($_POST["email"]);
    $guest->setFullName($_POST["nom"]);
    $guest->setPassword($_POST["password"]);
    $guest->setRole($_POST["role"]);
    if($guest->register()){
        header("location: ../../login.php?message=register success");
        exit();
    }
    else{
        echo "register problem";
    }
}