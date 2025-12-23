<?php 
$host = "localhost";
$user = "root";
$password = "";
$db_name = "ASSAD";

$conn = mysqli_connect($host,$user,$password,$db_name);

if(!$conn){
    die("connexion failed " . mysqli_connect_error());
}