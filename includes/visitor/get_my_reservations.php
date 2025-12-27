<?php
include '../../Classes/db.php';
include '../../Classes/Reservation.php';
session_start();
if(!isset($_SESSION['id'])){
    header('Location: /assad-2025/login.php');
    exit;
}
$user_id = $_SESSION['id'];

$pdo = new db();
$db = $pdo->connect();

$reservation = new reservation($db);
$reservations = $reservation->getReservationsByUser($user_id);

echo json_encode($reservations);
?>
