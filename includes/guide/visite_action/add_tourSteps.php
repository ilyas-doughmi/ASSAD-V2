<?php
require_once("../../db.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = $_POST["step_title"];
    $description = $_POST["step_description"];
    $etape = $_POST["step_order"];
    $tour_id = $_POST["tour_id"];


    $query = "INSERT INTO tour_step(titre_etape,description_etape,order_etape,tour_id)
    VALUES(?,?,?,?)";
    $stmt = mysqli_prepare($conn,$query);

    if($stmt === false){
        die("die");
    }

    mysqli_stmt_bind_param($stmt,"ssii",$title,$description,$etape,$tour_id);

    try{
        mysqli_stmt_execute($stmt);
        echo "done";
    }catch(mysqli_sql_exception){
        echo "problem";
    }
    
}