<?php
require_once("../../db.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    
    $image = $_POST['image'];
    $titre = $_POST['title'];
    $description = $_POST['description'];
    $date_heure =$_POST['date'];
    $duree = $_POST['duree'];
    $prix = $_POST['prix'];
    $langue = $_POST['langue'];
    $capacite = $_POST['capacity'];
    $guide_id = $_POST["guide_id"];
    $status = "open";

    $query = "INSERT INTO tours(titre,description,date_heure_debut,duree_minutes,prix,langue,capacity_max
    ,guide_id,status,tour_image) VALUES(?,?,?,?,?,?,?,?,?,?)";
    
    $stmt = mysqli_prepare($conn,$query);
       if($stmt === false){
        die("Error prepare statement".mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt,"sssidsiiss",$titre,$description,$date_heure,$duree,$prix,$langue,$capacite,$guide_id,$status,$image);

        mysqli_stmt_execute($stmt);
        echo mysqli_insert_id($conn);
 
 
}