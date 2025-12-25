<?php


require_once("../../../Classes/db.php");
require_once("../../../Classes/Habitat.php");


$pdo = new db();
$habitat = new Habitat($pdo);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $habitat->setNom($_POST['nom']);
    $habitat->setZoneZoo($_POST['zone_zoo']);
    $habitat->setTypeClimat($_POST['type_climat']);
    $habitat->setDescription($_POST['description']);
    $habitat->setImage($_POST['image']);

    $habitat->createHabitat();

    header('Location: ../../../pages/admin/manage_habitats.php');
    exit;
}

