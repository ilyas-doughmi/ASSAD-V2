<?php
require_once("../../Classes/db.php");
require_once("../../Classes/commentaire.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['id'];
    $tour_id = $_POST['tour_id'];
    $note = $_POST['note'];
    $comment = trim($_POST['comment']);

    $db = new db();
    $pdo = $db->connect();

    $commentaire = new commentaire($pdo);
    $commentaire->setUserId($user_id);
    $commentaire->setTourId($tour_id);
    $commentaire->setNote($note);
    $commentaire->setTexte($comment);

    try {
        $commentaire->addCommentaire();
        echo 'ok';
    } catch (Exception $e) {
        echo 'error';
    }
}



