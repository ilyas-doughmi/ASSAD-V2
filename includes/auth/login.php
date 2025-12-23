<?php

require_once("../db.php");
$message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    if (!preg_match('/^[^@\s]+@[^@\s]+\.[^@\s]+$/', $email)) {
        $message = "Invalid email format";
        header("location: ../../login.php?message=" . $message);
        exit();
    }

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt === false) {
        die("Error prepare statement" . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if ($user =  mysqli_fetch_assoc($result)) {
        if (password_verify($password, $user["password"])) {
            if($user["isBanned"] == 1){
                header("location: ../../index.php?message=account_banned");
                exit();
            }
            else{
                session_start();
                $_SESSION["id"] = $user["id"];
                $_SESSION["role"] = $user["role"];
                $_SESSION["isActive"] = $user["isActive"];
                 switch($user["role"]){
                case 'admin':
                    header("location: ../../pages/admin/admin_dashboard.php");
                    exit();
                case 'guide':
                    header("location: ../../pages/guide/guide_dashboard.php");
                    exit();
                default:
                    header("location: ../../index.php");
                    exit();
            }
            }
           
      
           
            $message = "Login Succ";
        } else {
            $message = "password problem";
        }
    } else {
        $message = "account not found";
    }

    header("location: ../../login.php?message=" . $message);
    exit();
}
