<?php
session_start();

require_once("../../../Classes/db.php");
require_once("../../../Classes/Reservation.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $tour_id = $_POST["reserve"];
    $user_id = $_SESSION["id"];

    $db = new db();
    $pdo = $db->connect();

    $reservation = new reservation($pdo);
    $reservation->setUserId($user_id);
    $reservation->setTourId($tour_id);

    try{
        $reservation->createReservation();
        echo "reservation success";

    }catch(Exception $e){
        die($tour_id);
    }
}