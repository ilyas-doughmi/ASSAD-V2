<?php
require_once("../../db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nom = $_POST['nom'];
    $zone = $_POST['zone_zoo'];
    $climat = $_POST['type_climat'];
    $description = $_POST['description'];
    
    $image = $_POST['image']; 

    $query = "INSERT INTO habitat (nom, description, image) VALUES (?, ?, ?)";
    
    $stmt = mysqli_prepare($conn, $query);
    
    if ($stmt === false) {
        die("Erreur de préparation : " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "sss", $nom, $description, $image);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: ../../../pages/admin/manage_habitats.php?msg=added");
        exit();
    } else {
        echo "Erreur d'exécution : " . mysqli_error($conn);
    }
}
?>