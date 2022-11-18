<?php

require_once "components/db_connect.php";

$mysql = "SELECT * FROM animal";
$result = mysqli_query($connect, $mysql);
$list = "";

if (mysqli_num_rows($result) > 0) {
    while ($article = mysqli_fetch_assoc($result)) {
        $list .= "
        <tr>
           <td><a href=''><img class='image' src='pictures/" . $article["photo"] . "'></a></td>
           <td>" . $article['breed'] . "</td>
           <td>" . $article['size'] . "</td>
           <td>" . $article['age'] . " years</td>
           <td>" . $article['vaccinated'] . "</td>
           <td><a href='details.php?id=" . $article["animal_id"] . "'><button class='btn btn-info' type='button'>Show Details</button></a></td>
           ";
    }
} else {
    $list = "<tr><td colspan='4' class='text-center'>No data available</td></tr>";
}

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
    .btn-secondary {
        text-align: center;
        margin: auto;
        width: 20%;
    }

    .animals {
            width: 80%;
            margin: 0 auto;
            padding-top: 5%;
    }

    td,
    tr {
        text-align: center;
        vertical-align: middle;
    
    }

    .image {
        width: 300px;
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
                    <a class="nav-link active" href="login.php">Login</a>
                </div>
            </div>
        </div>
    </nav>

    </div>
    <div class="bg-container">
        <div class="animals">
            <p class="h1 text-center font-monospace text-decoration-underline mb-5">Pets available</p>
            <table class='table table-striped table-dark table-hover'>
                <thead>
                    <tr>
                        <th>Picture</th>
                        <th>Breed</th>
                        <th>Size</th>
                        <th>Age</th>
                        <th>Vaccinated</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $list ?>
                </tbody>
            </table>
        </div>
</body>

</html>