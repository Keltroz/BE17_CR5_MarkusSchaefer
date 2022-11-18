<?php

session_start();

require_once "components/db_connect.php";

if (isset($_SESSION["user"])) {
    header("Location: indexUser.php");
    exit;
}

// if (isset($_SESSION["admin"])) {
//     header("Location: dashboard.php");
//     exit;

// }

$mysql = "SELECT * FROM animal";
$result = mysqli_query($connect, $mysql);
$list = "";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $list .= "
        <tr>
           <td><a href=''><img class='image' src='pictures/" . $row["photo"] . "'></a></td>
           <td>" . $row['breed'] . "</td>
           <td>" . $row['size'] . "</td>
           <td>" . $row['age'] . " years</td>
           <td>" . $row['vaccinated'] . "</td>
           <td><a href='details.php?id=" . $row["animal_id"] . "'><button class='btn btn-info' type='button'>Show Details</button></a></td>
           ";
    }
} else {
    $list = "<tr><td colspan='4' class='text-center'>No data available</td></tr>";
}

mysqli_close($connect);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Review 5</title>
    <?php require_once "components/boot.php" ?>
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
                    <a class="nav-link active" href="index.php">Home</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Animals
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="home.php">All</a></li>
                            <li><a class="dropdown-item" href="./animals/senior.php">Senior (8+ years)</a></li>
                        </ul>
                    </li>
                </div>
                <div style="margin-left:auto; margin-right: 20px;">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="login.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    </div>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-12 my-5">
                <div class="card alert-info" style="border:none; width: 60%; margin: 0 auto;">
                    <div class="card-body text-center mt-2">
                        <h1>Welcome to Shelty</h1>
                        <h3>Your shelter near you</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h3 class="text-center">You are searching for someone who gives unconditional love, then we may have the perfect fit for you</h3>
    <p class="text-center">Please <a href="login.php" class="fw-bold text-body"><u>Log in</u></a> to see our pets</p>
</body>

</html>