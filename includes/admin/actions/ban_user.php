<?php
require_once("../../db.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user_id = $_POST["user_id"];
    
    $query = "UPDATE users SET isBanned = 1 WHERE id = ?";

    $stmt = mysqli_prepare($conn,$query);
    
    if ($stmt === false) {
        die("Error prepare statement" . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt,"i",$user_id);
    mysqli_stmt_execute($stmt);

    echo "Active Successfully";
}