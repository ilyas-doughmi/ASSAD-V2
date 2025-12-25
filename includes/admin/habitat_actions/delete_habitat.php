<?php

require_once("../../../Classes/db.php");
require_once("../../../Classes/Habitat.php");

$pdo = new db();
$habitat = new Habitat($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $habitat->deleteHabitat($id);
}
?>