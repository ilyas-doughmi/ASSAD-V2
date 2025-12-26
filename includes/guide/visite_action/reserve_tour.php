<?php
session_start();

require_once("../../../Classes/db.php");
require_once("../../../Classes/Reservation.php");
require_once("../../../Classes/Tour.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $tour_id = intval($_POST["reserve"]);
    $user_id = $_SESSION["id"];
    $nb_personnes = isset($_POST["nb_personnes"]) ? intval($_POST["nb_personnes"]) : 1;
    
    // Validate nb_personnes
    if ($nb_personnes < 1) {
        echo json_encode(['success' => false, 'message' => 'Nombre de personnes invalide']);
        exit();
    }

    $db = new db();
    $pdo = $db->connect();
    
    // Check remaining capacity
    $tour = new Tour($pdo);
    $remaining = $tour->getRemainingCapacity($tour_id);
    
    if ($remaining < $nb_personnes) {
        echo json_encode(['success' => false, 'message' => "Capacité insuffisante. Places restantes: $remaining"]);
        exit();
    }

    $reservation = new reservation($pdo);
    $reservation->setUserId($user_id);
    $reservation->setTourId($tour_id);
    $reservation->setNbPersonnes($nb_personnes);

    try{
        $reservation->createReservation();
        echo json_encode(['success' => true, 'message' => 'Réservation réussie']);
    }catch(Exception $e){
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la réservation']);
    }
}