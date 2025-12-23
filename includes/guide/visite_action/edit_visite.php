<?php
require_once("../../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $date = $_POST['date_heure_debut'];
    $duree = $_POST['duree_minutes'];
    $prix = $_POST['prix'];
    $langue = $_POST['langue'];
    $capacite = $_POST['capacity_max'];
    $description = $_POST['description'];
    $image = $_POST['tour_image']; 

    $query = "UPDATE Tours SET 
              titre = ?, 
              description = ?, 
              date_heure_debut = ?, 
              duree_minutes = ?, 
              prix = ?, 
              langue = ?, 
              capacity_max = ?, 
              tour_image = ? 
              WHERE id = ?";
    
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt === false) {
        die("Erreur de préparation : " . mysqli_error($conn));
    }

    
    mysqli_stmt_bind_param($stmt, "sssidsssi", $titre, $description, $date, $duree, $prix, $langue, $capacite, $image, $id);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../../../pages/guide/guide_tours.php?msg=updated");
        exit();
    } else {
        echo "Erreur lors de la mise à jour : " . mysqli_error($conn);
    }
}
?>