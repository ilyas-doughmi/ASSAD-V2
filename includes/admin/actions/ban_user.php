<?php
require_once("../../../Classes/db.php");
require_once("../../../Classes/Visitor.php");


$pdo = new db();
$user = new Visitor($pdo);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user_id = $_POST["user_id"];
    $user->banAccount($user_id);
    echo "ban Successfully";
}