<?php
require_once("../../../Classes/db.php");
require_once("../../../Classes/tour_step.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = $_POST["step_title"];
    $description = $_POST["step_description"];
    $etape = $_POST["step_order"];
    $tour_id = $_POST["tour_id"];

    $db = new db();
    $pdo = $db->connect();

    $tourStep = new tour_step($pdo);
    $tourStep->setTitreEtape($title);
    $tourStep->setDescriptionEtape($description);
    $tourStep->setOrderEtape($etape);
    $tourStep->setTourId($tour_id);

    try{
        $tourStep->addStep();
        echo "done";
    }catch(Exception $e){
        echo "problem";
    }
    
}