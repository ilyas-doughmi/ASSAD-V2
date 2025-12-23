<?php
require_once("../../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nom = $_POST["nom"];
    $espece = $_POST["espece"];
    $pays = $_POST["pays"];
    $habitat_id = $_POST["habitat_id"]; 
    $description = $_POST["description"];
    $alimentation = $_POST["alimentation"];
    $image = $_POST["image"];

    $query = "INSERT INTO animal (nom, espece, pays_origin, habitat_id, description_courte, alimentation, image, vues) VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
    
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt === false) {
        die("Error prepare statement: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "sssisss", $nom, $espece, $pays, $habitat_id, $description, $alimentation, $image);

    try {
        if(mysqli_stmt_execute($stmt)){
            echo "success";
        } else {
            echo "error_exec: " . mysqli_error($conn);
        }
    } catch (mysqli_sql_exception $e) {
        echo "error: " . $e->getMessage();
    }
}
?>