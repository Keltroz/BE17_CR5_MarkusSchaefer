<?php

session_start();

require_once "../components/db_connect.php";

if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location: senior.php");
    exit;
}

if (isset($_SESSION["user"])) {
    header("Location: seniorUser.php");
    exit;
}

?>