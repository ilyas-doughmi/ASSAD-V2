<?php
require_once("../../Classes/db.php");
require_once("../../Classes/Tour.php");

$pdo = new db();
$tour = new Tour($pdo);

if(isset($_POST["gettours"])){
    echo json_encode($tour->getAllToursWithCapacity());
}

if(isset($_POST["get_remaining_capacity"])){
    $tour_id = intval($_POST["tour_id"]);
    echo $tour->getRemainingCapacity($tour_id);
}

?>
