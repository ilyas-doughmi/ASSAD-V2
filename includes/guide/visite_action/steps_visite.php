<?php 
require_once("../../db.php");

if(isset($_POST["show_steps"])){
    $tour_id = $_POST["show_steps"];
    echo getTourSteps($tour_id);
}


function getTourSteps($tour_id){
    global $conn;
    $query = "SELECT * FROM tour_step WHERE tour_id = ? ORDER BY order_etape ASC";
    $stmt = mysqli_prepare($conn,$query);

    if($stmt == false){
        die("die");
    }

    mysqli_stmt_bind_param($stmt,"i",$tour_id);

    mysqli_stmt_execute($stmt);
    
    $result = mysqli_stmt_get_result($stmt);
    return json_encode(mysqli_fetch_all($result,MYSQLI_ASSOC));

}   
