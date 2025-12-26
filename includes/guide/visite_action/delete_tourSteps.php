<?php
require_once("../../../Classes/db.php");
require_once("../../../Classes/tour_step.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST["step_id"];

    $db = new db();
    $pdo = $db->connect();

    $tourStep = new tour_step($pdo);

    try{
        $tourStep->deleteStep($id);
        echo "done";
    }catch(Exception $e){
        echo "problem";
    }
}
