<?php 

require_once("../../db.php");


if(isset($_POST["habitat_id"])){
    $habitat_id = $_POST["habitat_id"];
    echo habitat_name($habitat_id);
}


function habitat_name($id){
    global $conn;
    $query = "SELECT * FROM habitat WHERE id = ?";
    $stmt = mysqli_prepare($conn,$query);

    if ($stmt === false) {
        die("Error prepare statement" . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt,"i",$id);
    
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $data = mysqli_fetch_assoc($result);

    return $data["nom"];
}