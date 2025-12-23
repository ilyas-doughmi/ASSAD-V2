<?php
require_once __DIR__ . "/../db.php";

if(isset($_POST["gettours"])){
    echo getAllTours();
}

function getAllTours(){
    global $conn;
    $query = "SELECT * FROM tours WHERE status = 'open' AND date_heure_debut >= NOW() ORDER BY date_heure_debut ASC";
    $result = mysqli_query($conn, $query);
    return json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
}
?>
