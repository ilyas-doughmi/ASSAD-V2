<?php
require_once("../../db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $query = "DELETE FROM animal WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt === false) {
        die("Error prepare statement" . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "i", $id);

    try {
        mysqli_stmt_execute($stmt);
        echo "success";
    } catch (mysqli_sql_exception $e) {
        echo "error: " . $e->getMessage();
    }
}
?>