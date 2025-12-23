<?php
session_start();

require_once("../../db.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $tour_id = $_POST["reserve"];
    $user_id = $_SESSION["id"];
    $query = "INSERT INTO reservation(user_id,tour_id)
            VALUES(?,?)";

    $stmt = mysqli_prepare($conn,$query);

    if($stmt == false){
        die("die");
    }

    mysqli_stmt_bind_param($stmt,"ii",$user_id,$tour_id);

    try{
        mysqli_stmt_execute($stmt);
        echo "reservation success";

    }catch(mysqli_sql_exception $e){
        die($tour_id);
    }



    // $result = mysqli_stmt_get_result($stmt);
}