<?php

session_start();

require_once 'components/db_connect.php';

if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit;
}

$status = 'newcomer';
$mysql = "SELECT * FROM user WHERE status != '$status'";
$result = mysqli_query($connect, $mysql);
$list = '';
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $list .= "<tr>
            <td><img class='rounded-circle picture' src='./pictures/" . $row['picture'] . "' alt=" . $row['first_name'] . "></td>
            <td>" . $row['first_name'] . " " . $row['last_name'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['address'] . "</td>
            <td>" . $row['phone_number'] . "</td>
            <td>" . $row['status'] . "</td>
            <td><a href='delete.php?id=" . $row['user_id'] . "'><button class='btn btn-danger ms-1' type='button'>Delete</button></a></td>
         </tr>";
    }
} else {
    $list = "<tr><td colspan='7' class='text-center'>No Data Available</td></tr>";
}

$mysql2 = "SELECT * FROM animal";
$result2 = mysqli_query($connect, $mysql2);
$list2 = "";

if (mysqli_num_rows($result2) > 0) {
    while ($row2 = mysqli_fetch_assoc($result2)) {
        $list2 .= "
        <tr>
           <td><img class='picture' src='pictures/" . $row2["photo"] . "'></td>
           <td>" . $row2['breed'] . "</td>
           <td>" . $row2['size'] . "</td>
           <td>" . $row2['age'] . " years</td>
           <td>" . $row2['location'] . "</td>
           <td>" . $row2['vaccinated'] . "</td>
           <td><a href='animals/update.php?id=" . $row2["animal_id"] . "'><button class='btn btn-primary me-1' type='button' style='width: 70px;'>Edit</button></a>
           <a href='animals/delete.php?id=" . $row2["animal_id"] . "'><button class='btn btn-danger ms-1' type='button' style='width: 70px;'>Delete</button></a></td>
           </tr>";
    }
} else {
    $list2 = "<tr><td colspan='7' class='text-center'>No data available</td></tr>";
}



$query = "SELECT * FROM user WHERE user_id = {$_SESSION['admin']}";
$result3 = mysqli_query($connect, $query);
$row3 = mysqli_fetch_assoc($result3);

$fname = $row3['first_name'];
$lname = $row3['last_name'];
$email = $row3['email'];
$picture = $row3['picture'];
$status3 = $row3['status'];

mysqli_close($connect);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Review 5</title>
    <?php require_once 'components/boot.php' ?>
    <style type="text/css">
        .picture {
            width: 100px;
            height: 100px;
        }

        td,
        tr {
            text-align: center;
            vertical-align: middle;
        }

        .dash-container {
            margin: auto;
            width: 95%;
        }

        .btn-hidden {
            background-color: transparent;
            border-color: transparent;
            color: transparent; 
        }

        .btn.hidden:hover {
            pointer-events: none;
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

    <div class="mt-5 dash-container">
        <div class="row">
            <div class="col mt-2 me-5 text-center">
                <p class='h2' style="display: inline-block;">Animals<button class='btn btn-primary mb-2 ms-5' style="float: right" type="button" onclick="window.location.href='./animals/create.php'">Add Animal</button></p>
                <table class='table align-middle bg-white'>
                    <thead class='table-light'>
                        <tr>
                            <th>Picture</th>
                            <th>Breed</th>
                            <th>Size</th>
                            <th>Age</th>
                            <th>Location</th>
                            <th>Vaccinated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $list2 ?>
                    </tbody>
                </table>
            </div>
            <div class="col mt-2 ms5">
                <p class='h2 text-center mb-3'>Users</p>
                <table class='table align-middle bg-white'>
                    <thead class='table-light'>
                        <tr>
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $list ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>