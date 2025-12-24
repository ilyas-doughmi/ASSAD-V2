<?php
require_once("../../Classes/db.php");
require_once("../../Classes/Habitat.php");


$pdo = new db();
$habitat = new Habitat($pdo);

$habitat = $habitat->getAllHabitat();


if(isset($_POST["habitat"])){
    echo json_encode($habitat["habitats"]);
}

if(isset($_POST["habitat_count"])){
    echo $habitat["count"];
}
