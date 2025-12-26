<?php
require_once("../../../Classes/db.php");
require_once("../../../Classes/Tour.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $image = $_POST['image'];
    $titre = $_POST['title'];
    $description = $_POST['description'];
    $date_heure =$_POST['date'];
    $duree = $_POST['duree'];
    $prix = $_POST['prix'];
    $langue = $_POST['langue'];
    $capacite = $_POST['capacity'];
    $guide_id = $_POST["guide_id"];
    $status = "open";

    $db = new db();
    $pdo = $db->connect();

    $tour = new Tour($pdo);
    $tour->setTitle($titre);
    $tour->setDescription($description);
    $tour->setDateHeureDebut($date_heure);
    $tour->setDureeMinutes($duree);
    $tour->setPrix($prix);
    $tour->setLangue($langue);
    $tour->setCapacityMax($capacite);
    $tour->setGuideId($guide_id);
    $tour->setStatus($status);
    $tour->setTourImage($image);

    try {
        $tourId = $tour->createTour();
        echo $tourId;
    } catch (Exception $e) {
        die("Error creating tour: " . $e->getMessage());
    }
}