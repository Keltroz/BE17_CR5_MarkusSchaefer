<?php

session_start();

require_once "components/db_connect.php";

$list = "";
if ($_GET["id"]) {
    $id = $_GET["id"];
    $mysql = "SELECT * FROM animal WHERE animal_id = '$id'";
    $result = mysqli_query($connect, $mysql);

    if (mysqli_num_rows($result) == 1) {
        while ($data = mysqli_fetch_assoc($result)) {
            $list .=  "<tr><td class='text-center'><img class='image img-fluid' src='pictures/" . $data['photo'] . "' style='width: 400px;'></td></tr>
                        <td>" . $data['name'] . "</td>
                        <td>" . $data['size'] . "</td>
                        <td>" . $data['age'] . "</td>
                        <td>" . $data['vaccinated'] . "</td>
                        <td>" . $data['breed'] . "</td>
                        </tr>
                        <tr>
                        <td colspan='5'>" . $data['description'] . "</td>
                        </tr>";
        }
    } else {
        $list = "<tr><td colspan='4' class='text-center'>No data available</td></tr>";
    }
}

$query = "SELECT * FROM user WHERE user_id = {$_SESSION['user']}";
$result2 = mysqli_query($connect, $query);
$row2 = mysqli_fetch_assoc($result2);

$fname = $row2['first_name'];
$lname = $row2['last_name'];
$email = $row2['email'];
$picture = $row2['picture'];
$status = $row2['status'];

$query2 = "SELECT * FROM animal WHERE animal_id = '$id'";
$result3 = mysqli_query($connect, $query2);
$row3 = mysqli_fetch_assoc($result3);

$animalName = $row3['name'];
$breed = $row3['breed'];
$size = $row3['size'];
$age = $row3['age'];
$location = $row3['location'];
$vaccinated = $row3['vaccinated'];
$description = $row3['description'];
$pictureAnimal = $row3['photo'];

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
    <style type="text/CSS">

        .animals {
        margin: 5% auto;
        width: 80%;
    }
        td, tr {
            text-align: center;
            vertical-align: middle;
        }

        html, body {
            background-color: antiquewhite;
        }

        .card {
            background-color: rgb(245, 244, 241);
        }

        .nav-link:hover, .userNameNav:hover {
        text-decoration: underline !important; 
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
                    <li class="nav-item dropdown">
                        <a class="userNameNav active ms-2 text-light text-decoration-none" style="display:inline-block" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $email ?>
                        </a>
                        <a class="nav-link dropdown-toggle text-light" style="display:inline-block; text-decoration: none !important;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src='pictures/<?= $picture ?>' class="rounded-circle img-fluid" style="width: 45px; height: 45px">
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
                            <li><a class="dropdown-item" href="logout.php?logout">Logout</a></li>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>

    <div class="container text-center">
        <div class="card mt-5 pt-5 pe-5 pb-4 ps-5">
            <div class="row">
                <div class="col-6">
                    <img src="pictures/<?= $pictureAnimal ?>" class="img-fluid" style="width: 100%; height: 100%;" alt="">
                </div>


                <div class="col-6">
                    <div class="row mt-3">
                        <div class="col">
                            <h3><b><?= $animalName ?></b></h3>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table table-light mt-3">
                            <tr>
                                <th class="bg-danger">Breed</th>
                                <td><?= $breed ?></td>
                            </tr>
                            <tr>
                                <th class="bg-warning">Size</th>
                                <td><?= $size ?></td>
                            </tr>
                            <tr>
                                <th class="bg-success">Age</th>
                                <td><?= $age ?></td>
                            </tr>
                            <tr>
                                <th class="bg-primary">Location</th>
                                <td><?= $location ?></td>
                            </tr>
                            <tr>
                                <th class="bg-info">Vaccinated</th>
                                <td><?= $vaccinated ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <table class="table table-light mt-5">
                <tr>
                    <th class="bg-info">Description</th>
                </tr>
                <tr>
                    <td><?= $description ?></td>
                </tr>
            </table>
            <button class="btn btn-primary mt-4" style="width: 80px; display: block; margin: 0 auto" onclick="history.back()">Back</button>
        </div>
    </div>
</body>

</html>