<?php 
require_once("../../Classes/db.php");
require_once("../../Classes/User.php");
require_once("../../Classes/Admin.php");


$pdo = new db();
$admin = new Admin($pdo);
$all_users = $admin->getAllUsers("all");
$guides = $admin->getAllUsers("guides_ver");



if(isset($_POST["users_count"])){
    $type = $_POST["users_count"];
    switch($type){
        case "all":  echo $all_users["count"]; break;
        case "notactiveusers": echo $guides ["count"];break;
        default:
        echo "0";
        break;

    }
}

// if(isset($_POST["users"])){
//     $type = $_POST["users"];
//     switch($type){
//         case "all": echo getUsers("");break;
//         case "pending": echo getUsers("");break;
//         default:
//         echo "no one found";
//         break;
//     }
// }
