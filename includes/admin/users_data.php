<?php 
require_once("../../Classes/db.php");
require_once("../../Classes/User.php");


$pdo = new db();
$user = new User($pdo);
$all_users = $user->getAllUsers();
$guides = $user->getAllUsers("guides_ver");



if(isset($_POST["users_count"])){
    $type = $_POST["users_count"];
    switch($type){
        case "all":  echo $all_users["count"]; break;
        case "notactiveusers": echo $guides["count"] ;break;
        default:
        echo "0";
        break;

    }
}

if(isset($_POST["users"])){
    $type = $_POST["users"];
    switch($type){
        case "all": echo json_encode($all_users["users"]);break;
        case "pending": echo json_encode($guides["users"]);break;
        default:
        echo "no one found";
        break;
    }
}
