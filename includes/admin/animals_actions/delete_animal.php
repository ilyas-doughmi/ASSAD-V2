<?php
require_once("../../../Classes/db.php");
require_once("../../../Classes/Animal.php");


$pdo = new db();
$animal = new Animal($pdo);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $animal->deleteAnimal($id);
}
?>