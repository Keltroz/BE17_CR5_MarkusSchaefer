<?php

session_start();

require_once "../components/db_connect.php";

if (isset($_SESSION["user"])) {
    header("Location: seniorUser.php");
    exit;
}

if (isset($_SESSION["admin"])) {
    header("Location: seniorUser.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Review 5</title>
    <?php require_once "../components/boot.php" ?>
</head>
<style type="text/CSS">
    .nav-link:hover, .userNameNav:hover {
        text-decoration: underline !important; 
    }
</style>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Shelter</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" href="../index.php">Home</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Animals
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../home.php">All</a></li>
                            <li><a class="dropdown-item" href="senior.php">Senior (8+ years)</a></li>
                        </ul>
                    </li>
                </div>
                <div style="margin-left:auto; margin-right: 20px;">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="../login.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12 my-5">
                <div class="card alert-danger" style="border:none; width: 60%; margin: 0 auto;">
                    <div class="card-body text-center mt-2">
                        <h1>Please log in to see our senior pets</h1>
                        <div class="d-flex justify-content-center mt-3">
                            <a href="../login.php"><button type="submit" class="btn btn-primary btn-lg btn-block" name="btn-login" style="width: 150px">Log in</button></a>
                        </div>
                        <p class="text-center text-muted mt-3">Don't have an account? <a href="../register.php" class="fw-bold text-body"><u>Register here</u></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>