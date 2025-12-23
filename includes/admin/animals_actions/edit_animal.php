<?php
require_once("../../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST["id"];
    $nom = $_POST["nom"];
    $espece = $_POST["espece"];
    $pays = $_POST["pays"];
    $habitat_id = $_POST["habitat_id"];
    $description = $_POST["description"];
    $alimentation = $_POST["alimentation"];
    $image = $_POST["image"];

    $query = "UPDATE animal SET nom = ?, espece = ?, pays_origin = ?, habitat_id = ?, description_courte = ?, alimentation = ?, image = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt === false) {
        die("Error prepare statement" . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "sssisssi", $nom, $espece, $pays, $habitat_id, $description, $alimentation, $image, $id);

    try {
        mysqli_stmt_execute($stmt);
        echo "success";
    } catch (mysqli_sql_exception $e) {
        echo "error: " . $e->getMessage();
    }
}
?>