<?php
session_start();
require_once __DIR__ . "/../db.php";

$guide_id = isset($_SESSION['id']) ? $_SESSION['id'] : 0;

if(isset($_POST["gettours"])){
    echo getTours($guide_id);
}
if(isset($_POST["get_stats"])){
    echo getGuideStats($guide_id);
}
if(isset($_POST["get_bookings"])){
    echo getGuideBookings($guide_id);
}
if(isset($_POST["get_upcoming"])){
    echo getUpcomingTours($guide_id);
}

function getTours($id){
    global $conn;
    $query = "SELECT * FROM tours WHERE guide_id = ? ORDER BY date_heure_debut DESC";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
}

function getGuideStats($id){
    global $conn;
    
    $query1 = "SELECT COUNT(*) as count FROM tours WHERE guide_id = ? AND MONTH(date_heure_debut) = MONTH(CURRENT_DATE())";
    $stmt1 = mysqli_prepare($conn, $query1);
    mysqli_stmt_bind_param($stmt1, "i", $id);
    mysqli_stmt_execute($stmt1);
    $res1 = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt1));
    
    $query2 = "SELECT COUNT(*) as count FROM reservation r JOIN tours t ON r.tour_id = t.id WHERE t.guide_id = ?";
    $stmt2 = mysqli_prepare($conn, $query2);
    mysqli_stmt_bind_param($stmt2, "i", $id);
    mysqli_stmt_execute($stmt2);
    $res2 = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt2));

    $query3 = "SELECT AVG(note) as avg FROM comments c JOIN tours t ON c.tour_id = t.id WHERE t.guide_id = ?";
    $stmt3 = mysqli_prepare($conn, $query3);
    mysqli_stmt_bind_param($stmt3, "i", $id);
    mysqli_stmt_execute($stmt3);
    $res3 = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt3));

    return json_encode([
        "tours_month" => $res1['count'],
        "visitors" => $res2['count'],
        "rating" => $res3['avg'] ? round($res3['avg'], 1) : "N/A"
    ]);
}

function getGuideBookings($id){
    global $conn;
    $query = "SELECT r.id as res_id, u.full_name, t.titre, t.date_heure_debut, t.prix, r.date_reservation 
              FROM reservation r 
              JOIN users u ON r.user_id = u.id 
              JOIN tours t ON r.tour_id = t.id 
              WHERE t.guide_id = ? 
              ORDER BY r.date_reservation DESC";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
}

function getUpcomingTours($id){
     global $conn;
    $query = "SELECT * FROM tours WHERE guide_id = ? AND date_heure_debut >= NOW() ORDER BY date_heure_debut ASC LIMIT 5";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));
}

function getTourInfo($tour_id){
    global $conn;
    $query = "SELECT * FROM tours WHERE id = ?";
    $stmt = mysqli_prepare($conn,$query);
    if($stmt == false){ die("problem"); }
    mysqli_stmt_bind_param($stmt,"i",$tour_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}

function getGuideName($user_id){
    global $conn;
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn,$query);
    if($stmt == false){ die("problem"); }
    mysqli_stmt_bind_param($stmt,"i",$user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_fetch_assoc($result);
}
?>