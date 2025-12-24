<?php


require_once("../../../Classes/db.php");
require_once("../../../Classes/Habitat.php");


$pdo = new db();
$habitat = new Habitat($pdo);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nom = $_POST['nom'];
    $zone = $_POST['zone_zoo'];
    $climat = $_POST['type_climat'];
    $description = $_POST['description'];
    
    $image = $_POST['image']; 


    $habitat->createHabitat($nom,$description,$image,$climat,$zone);

    header("location: ../../../pages/admin/manage_habitats.php");
    exit;
}

