<?php
require_once("../db.php");


if(isset($_POST["animals"])){
    echo getAnimals();
}

if(isset($_POST["animals_count"])){
    echo getCount();
}


function getAnimals(){
    global $conn;
    $query = "SELECT * FROM animal";
    $run = mysqli_query($conn,$query);
    $result = mysqli_fetch_all($run,MYSQLI_ASSOC);

    return json_encode($result);
}

function getCount(){
    global $conn;
    $query = "SELECT COUNT(*) as count FROM animal";
    $run = mysqli_query($conn,$query);
    $result = mysqli_fetch_assoc($run);
    return $result["count"];
}