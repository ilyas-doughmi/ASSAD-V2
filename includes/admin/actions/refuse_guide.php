<?php
require_once("../../../Classes/db.php");
require_once("../../../Classes/User.php");
require_once("../../../Classes/guide.php");


$pdo = new db();
$guide = new guide($pdo);

if($_SERVER["REQUEST_METHOD"] == "POST"){    
    $guide_id = $_POST["user_id"];
    $guide->rejectGuide($guide_id);
    echo "rejected Successfully";
}