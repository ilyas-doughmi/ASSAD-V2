<?php
include(dirname(__DIR__).'/db.php');
session_start();
if(!isset($_SESSION['id'])){
    header('Location: /assad-2025/login.php');
    exit;
}
$user_id = $_SESSION['id'];
$res = mysqli_query($conn, "SELECT * FROM tours WHERE id IN (SELECT tour_id FROM reservation WHERE user_id = $user_id) ORDER BY date_heure_debut DESC");
$reservations = [];
while($row = mysqli_fetch_assoc($res)){
    $reservations[] = $row;
}
echo json_encode($reservations);
?>
