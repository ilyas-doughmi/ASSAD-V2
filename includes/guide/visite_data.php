<?php
session_start();
require_once("../../Classes/db.php");
require_once("../../Classes/User.php");
require_once("../../Classes/guide.php");
require_once("../../Classes/Tour.php");


$pdo = new db();
$guide = new guide($pdo);
$tour = new tour($pdo);

$guide_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;

$tours = $tour->getToursByGuide($guide_id);


if(isset($_POST["gettours"])){
    echo json_encode($tours);
}

if(isset($_POST["get_stats"])){
    echo json_encode($guide->getGuideStats($guide_id));
}

if(isset($_POST["get_bookings"])){
    echo json_encode($guide->getGuideBookings($guide_id));
}

if(isset($_POST["get_upcoming"])){
    echo json_encode($tour->getUpcomingTours($guide_id));
}
?>