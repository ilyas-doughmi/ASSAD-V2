<?php
require_once("../../Classes/db.php");
require_once("../../Classes/Reservation.php");

$tour_id = $_GET['tour_id'];

$pdo = new db();
$db = $pdo->connect();

$reservation = new reservation($db);
echo $reservation->countReservationsByTour($tour_id);
?>
