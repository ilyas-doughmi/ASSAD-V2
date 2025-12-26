<?php
require_once("../../../Classes/db.php");
require_once("../../../Classes/Tour.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];

    $db = new db();
    $pdo = $db->connect();
    $tour = new tour($pdo);

    try {
        if($tour->cancelTour($id)){
            echo "success";
        } else {
            echo "error_exec";
        }
    } catch (Exception $e) {
        echo "error: " . $e->getMessage();
    }
}
?>