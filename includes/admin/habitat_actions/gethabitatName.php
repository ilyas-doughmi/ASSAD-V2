<?php 

require_once("../../../Classes/db.php");
require_once("../../../Classes/Habitat.php");

$pdo = new db();
$habitat = new Habitat($pdo);

if(isset($_POST["habitat_id"])){
    $habitat_id = $_POST["habitat_id"];
    $habitat->getHabitatById($habitat_id);  
}


