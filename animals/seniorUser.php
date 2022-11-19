<?php

session_start();

require_once "../components/db_connect.php";

if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location: senior.php");
    exit;
}

if (isset($_SESSION["admin"])) {
    header("Location: seniorAdmin.php");
    exit;
}

$list = "";
$mysql = "SELECT * FROM animal WHERE age >= 8";
$result = mysqli_query($connect, $mysql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $list .=  "<tr><td class='text-center'><img class='image' src='../pictures/" . $row['photo'] . "'></td>
                        <td class='text-center'>" . $row['name'] . "</td>
                        <td class='text-center'>" . $row['size'] . "</td>
                        <td class='text-center'>" . $row['age'] . "</td>
                        <td class='text-center'>" . $row['description'] . "</td>
                        <td class='text-center'>" . $row['vaccinated'] . "</td>
                        <td class='text-center'>" . $row['breed'] . "</td>
                        </tr>";
    }
} else {
    $list = "<tr><td colspan='4' class='text-center'>No data available</td></tr>";
}

$query = "SELECT * FROM user WHERE user_id = {$_SESSION['user']}";
$result2 = mysqli_query($connect, $query);
$row2 = mysqli_fetch_assoc($result2);

$fname = $row2['first_name'];
$lname = $row2['last_name'];
$email = $row2['email'];
$picture = $row2['picture'];
$status = $row2['status'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Review 5</title>
    <?php require_once "../components/boot.php" ?>
    <style type="text/CSS">

        .animals {
        margin: 5% auto;
        width: 80%;
    }

        td,
        tr {
            text-align: center;
            vertical-align: middle;
            border-left: 1px solid white;
            border-right: 1px solid white;
        }

        .image {
            width: 200px;
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand mb-1">Shelter</a>
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
                    <li class="nav-item dropdown">
                        <a class="userNameNav active ms-2 text-light text-decoration-none" style="display:inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $email ?>
                        </a>
                        <a class="nav-link dropdown-toggle text-light" style="display:inline-block; text-decoration: none !important;"" href=" #" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src='../pictures/<?= $picture ?>' class="rounded-circle img-fluid" style="width: 45px; height: 45px">
                        </a>
                        <ul class="dropdown-menu">
                            <!-- <li><a class="dropdown-item" href="../dashboard.php">Dashboard</a></li> -->
                            <li><a class="dropdown-item" href="../logout.php?logout">Logout</a></li>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>
    <div class="animals">
        <p class="h1 text-center text-decoration-underline mb-5">Senior Pets Available</p>
        <table class='table table-striped table-dark table-hover'>
            <thead>
                <tr>
                    <th class="text-center">Picture</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Size</th>
                    <th class="text-center">Age</th>
                    <th class="text-center" style="width: 40%;">Description</th>
                    <th class="text-center">Vaccinated</th>
                    <th class="text-center" style="width: 10%">Breed</th>
                </tr>
            </thead>
            <tbody>
                <?= $list ?>
            </tbody>
        </table>
    </div>
</body>

</html>