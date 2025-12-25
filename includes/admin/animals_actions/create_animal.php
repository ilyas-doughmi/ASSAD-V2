<?php

require_once("../../../Classes/db.php");
require_once("../../../Classes/Animal.php");

$pdo = new db();
$animal = new Animal($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $animal->setNom($_POST['nom']);
    $animal->setEspece($_POST['espece']);
    $animal->setPaysOrigin($_POST['pays']);
    $animal->setHabitatId((int) $_POST['habitat_id']);
    $animal->setDescription($_POST['description']);
    $animal->setAlimentation($_POST['alimentation']);
    $animal->setImage($_POST['image']);

    $animal->createAnimal();
}
