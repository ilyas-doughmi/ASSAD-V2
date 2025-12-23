<?php
include(dirname(__DIR__).'/db.php');
session_start();

$user_id = $_SESSION['id'];
$tour_id = $_POST['tour_id'];
$note = $_POST['note'];
$comment = trim($_POST['comment']);

$stmt = $conn->prepare("INSERT INTO comments (user_id, tour_id, note, texte) VALUES (?, ?, ?, ?)");
$stmt->bind_param('iiis', $user_id, $tour_id, $note, $comment);
$stmt->execute();
echo 'ok';


