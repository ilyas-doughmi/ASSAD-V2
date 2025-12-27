<?php
require_once("../../../Classes/db.php");
require_once("../../../Classes/Tour.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $pdo = new db();
    $db = $pdo->connect(); 

    $tour = new tour($db);

    $tour->setId($_POST['id']);
    $tour->setTitle($_POST['titre']);
    $tour->setDescription($_POST['description']);
    $tour->setDateHeureDebut($_POST['date_heure_debut']);
    $tour->setDureeMinutes($_POST['duree_minutes']);
    $tour->setPrix($_POST['prix']);
    $tour->setLangue($_POST['langue']);
    $tour->setCapacityMax($_POST['capacity_max']);
    $tour->setTourImage($_POST['tour_image']);

    if ($tour->editTour()) {
        header("Location: ../../../pages/guide/guide_tours.php?msg=updated");
        exit();
    } else {
        echo "Erreur lors de la mise à jour.";
    }
}
?>