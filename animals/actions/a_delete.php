<?php

session_start();

require_once '../../components/db_connect.php';

if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location: ../../index.php");
    exit;
}
if (isset($_SESSION["user"])) {
    header("Location: ../../indexe.php");
    exit;
}
if ($_POST) {
    $id = $_POST['animal_id'];
    $picture = $_POST['photo'];
    ($picture == "animal_avatar.png") ?: unlink("../../pictures/$picture");

    $mysql = "DELETE FROM animal WHERE animal_id = {$id}";
    if (mysqli_query($connect, $mysql) == TRUE) {
        $class = "success";
        $message = "Entry successfully deleted!";
    } else {
        $class = "danger";
        $message = "The entry was not deleted due to: <br>" . $connect->error;
    }
    mysqli_close($connect);
} else {
    header("location: ../error.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Review 5</title>
    <?php require_once "../../components/boot.php" ?>

    <style type="text/CSS">
        .alert-container {
            width: 20%;
        }
            
        .btn {
            width: 80px;
        }
    </style>
</head>

<body>
    <div class="container text-center alert-container mt-5">
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p class="fs-3 mb-4"><?= $message ?></p>
            <a href='../../dashboard.php'><button class="btn btn-success" type='button'>Ok</button></a>
        </div>
    </div>
</body>

</html>