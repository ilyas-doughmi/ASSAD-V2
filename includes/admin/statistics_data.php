<?php
require_once("../../Classes/db.php");
require_once("../../Classes/Admin.php");
require_once("../../Classes/Animal.php");

$pdo = new db();
$admin = new Admin($pdo);
$animal = new Animal($pdo);

// Get most viewed animals
if(isset($_POST["most_viewed_animals"])){
    $limit = isset($_POST["limit"]) ? intval($_POST["limit"]) : 5;
    $animals = $animal->getMostViewedAnimals($limit);
    echo json_encode($animals);
    exit();
}

// Get most reserved tours
if(isset($_POST["most_reserved_tours"])){
    $limit = isset($_POST["limit"]) ? intval($_POST["limit"]) : 5;
    $tours = $admin->getMostReservedTours($limit);
    echo json_encode($tours);
    exit();
}

// Get visitors by country
if(isset($_POST["visitors_by_country"])){
    $countries = $admin->getVisitorsByCountry();
    echo json_encode($countries);
    exit();
}

// Get total visitors
if(isset($_POST["total_visitors"])){
    $count = $admin->getTotalVisitors();
    echo $count;
    exit();
}

// Get total animals
if(isset($_POST["total_animals"])){
    $count = $admin->getTotalAnimals();
    echo $count;
    exit();
}

// Get total revenue
if(isset($_POST["total_revenue"])){
    $revenue = $admin->getTotalRevenue();
    echo $revenue;
    exit();
}
