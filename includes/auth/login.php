<?php 

require_once("../../Classes/db.php");
require_once("../../Classes/guest_not_connected.php");


$pdo = new db;
$guest = new guest_not_connected($pdo);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $guest->signin($email,$password);
}

