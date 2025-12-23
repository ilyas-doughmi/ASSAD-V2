<?php
require_once("../../includes/db.php");

$tour_id = $_GET['tour_id'];

$query = "SELECT COUNT(*) as count FROM reservation WHERE tour_id = ?";

$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $tour_id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
echo $row['count'];
?>
