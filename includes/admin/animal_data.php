<?php
require_once("../../Classes/db.php");
require_once("../../Classes/Animal.php");


$pdo = new db();
$animal = new Animal($pdo);
$animals = $animal->getAllAnimals();
$animals_count = $animals["count"];


if(isset($_POST["animals"])){
    echo json_encode($animals["animals"]);  
}

if(isset($_POST["animals_count"])){
    echo $animals_count;
}
