<?php
require_once("../../../Classes/db.php");
require_once("../../../Classes/User.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user_id = $_POST["user_id"];
    
    $pdo = new db();
    $db = $pdo->connect();
    $user = new User($pdo); 

    if ($user->unbanUser($user_id)) {
        echo "Active Successfully";
    } else {
        echo "Error activating account";
    }
}