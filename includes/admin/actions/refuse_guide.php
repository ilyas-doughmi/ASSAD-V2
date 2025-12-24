<?php
require_once("../../../Classes/db.php");
require_once("../../../Classes/User.php");
require_once("../../../Classes/Admin.php");


$pdo = new db();
$admin = new Admin($pdo);

if($_SERVER["REQUEST_METHOD"] == "POST"){    
    $guide_id = $_POST["user_id"];
    $admin->rejectGuide($guide_id);
    echo "Active Successfully";
}