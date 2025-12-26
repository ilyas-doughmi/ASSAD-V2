<?php 
require_once("../../../Classes/db.php");
require_once("../../../Classes/tour_step.php");

if(isset($_POST["show_steps"])){
    $tour_id = $_POST["show_steps"];
    
    $db = new db();
    $pdo = $db->connect();
    $tourStep = new tour_step($pdo);
    
    $steps = $tourStep->getStepsByTourId($tour_id);
    echo json_encode($steps);
}
