<?php
require_once("../../../Classes/db.php");
require_once("../../../Classes/Animal.php");


$pdo = new db();
$animal = new Animal($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST["id"];
    $nom = $_POST["nom"];
    $espece = $_POST["espece"];
    $pays = $_POST["pays"];
    $habitat_id = $_POST["habitat_id"];
    $description = $_POST["description"];
    $alimentation = $_POST["alimentation"];
    $image = $_POST["image"];

  $animal->editAnimal($nom,$espece,$pays,$habitat_id,$description,$alimentation,$image,$id);
}
?>