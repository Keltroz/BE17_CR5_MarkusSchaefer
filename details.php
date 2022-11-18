<?php

require_once "components/db_connect.php";

$list = "";
if ($_GET["id"]) {
    $article = $_GET["id"];
    $mysql = "SELECT * FROM animal WHERE animal_id = '$article'";
    $result = mysqli_query($connect, $mysql);

    if (mysqli_num_rows($result) == 1) {
        while ($data = mysqli_fetch_assoc($result)) {
            $list .=  "<tr><td class='text-center'><img class='image' src='pictures/" . $data['photo'] . "'></td>
                        <td class='text-center'>" . $data['name'] . "</td>
                        <td style='border-right: none; text-align: right;'>" . $data['size'] . "</td>
                        <td style='border-left: none; text-align: left;'>" . $data['age'] . "</td>
                        <td class='text-center'>" . $data['vaccinated'] . "</td>
                        <td class='text-center'>" . $data['description'] . "</td>
                        <td class='text-start'>" . $data['breed'] . "</td>
                        </tr>";
        }
    } else {
        $list = "<tr><td colspan='4' class='text-center'>No data available</td></tr>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Review 4</title>
    <?php require_once "components/boot.php" ?>
    <style type="text/CSS">

    .bg-container {
        margin: 5% auto;
        width: 80%;
    }

    html,
    body {
            background-color: antiquewhite;
        }

        td,
        tr {
            text-align: center;
            vertical-align: middle;
            border-left: 1px solid white;
            border-right: 1px solid white;
        }

        .image {
            width: 100px;
        }

    </style>
</head>

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
                            <li><a class="dropdown-item" href="./animals/index.php">All</a></li>
                            <li><a class="dropdown-item" href="./animals/senior.php">Senior (8+ years)</a></li>
                        </ul>
                    </li>
                    <a class="nav-link active" href="login.php">Login</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="bg-container">
        <div class="products">
            <p class="h1 text-center font-monospace text-decoration-underline mb-5">Details</p>
            <table class='table table-striped table-dark table-hover'>
                <thead>
                    <tr>
                        <th class="text-center" style="width:10%;">Image</th>
                        <th class="text-center" style="width: 10%;">Title</th>
                        <th class="text-center" colspan="2" style="width: 10%;">Author</th>
                        <th class="text-center" style="width: 10%;">ISBN</th>
                        <th class="text-center" style="width: 50%;">Description</th>
                        <th class="text-center" style="width: 10%;">Availability</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $list ?>
                </tbody>
            </table>
            <div class="button">
                <button class='btn btn-primary mt-3' type="button" onclick="window.location.href='index.php'" style="width: 80px;">Back</button>
            </div>
        </div>
</body>

</html>