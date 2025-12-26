<?php
require_once("../../Classes/db.php");
require_once("../../Claases/Tour.php");

$pdo = new db();
$tour =  new Tour($pdo);

if(isset($_POST["gettours"])){
    echo json_encode($tour->getAllTour());
}

?>
