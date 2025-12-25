<?php 

require_once("../../Classes/db.php");
require_once("../../Classes/User.php");


$pdo = new db;
$guest = new User($pdo);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $guest->setEmail($_POST["email"]);
    $guest->setPassword($_POST["password"]);
    $guest->signin();
}

