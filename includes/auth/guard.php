<?php

session_start();

function require_login()
{
    if (!isset($_SESSION["user_id"])) {
        header("location: ../../login.php");
        exit();
    }
}

function require_role($role_needed)
{
    if (!isset($_SESSION["role"]) || $_SESSION["role"] != $role_needed || $_SESSION["isActive"] == 0 && $_SESSION["role"] == "guide") {
        if($_SESSION["isActive"] == 0 && $_SESSION["role"] == "guide"){
            header("location: ../../pages/guide/pending.php");
            exit();
        }
        else{
            header("location: ../../index.php?message=no_access");
            exit();
        }

    }
}
