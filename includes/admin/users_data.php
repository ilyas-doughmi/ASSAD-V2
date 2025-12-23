<?php 
require_once("../db.php");


if(isset($_POST["users_count"])){
    $type = $_POST["users_count"];
    switch($type){
        case "all":  echo getUsersCount(""); break;
        case "notactiveusers": echo getUsersCount("WHERE isActive = 0 AND role = 'guide'");break;
        default:
        echo "0";
        break;

    }
}

if(isset($_POST["users"])){
    $type = $_POST["users"];
    switch($type){
        case "all": echo getUsers("");break;
        case "pending": echo getUsers("WHERE isActive = 0 AND role = 'guide'");break;
        default:
        echo "no one found";
        break;
    }
}



function getUsersCount($condition = ""){
    global $conn;
    $query= "SELECT COUNT(*) as count FROM users $condition";
    $result = mysqli_query($conn,$query);
    if($result){
    $row = mysqli_fetch_assoc($result);
    return $row["count"];
    }
    return 0;
   
}


function getUsers($user_condition){
    global $conn;
    $query = "SELECT * FROM users $user_condition";
    $result = mysqli_query($conn,$query);

    $row = mysqli_fetch_all($result,MYSQLI_ASSOC);

    return json_encode($row);
}