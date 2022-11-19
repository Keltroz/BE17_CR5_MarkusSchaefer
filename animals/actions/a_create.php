<?php

session_start();

require_once "../../components/db_connect.php";
require_once "../../components/file_upload.php";

if(!isset($_SESSION["user"]) && !isset($_SESSION["admin"]) || isset($_SESSION["user"])){
    header("Location: ../index.php");
    exit;
}

if($_POST){
    $name = $_POST["name"];
    $breed = $_POST["breed"];
    $size = $_POST["size"];
    $age = $_POST["age"];
    $location = $_POST["location"];
    $vaccinated = $_POST["vaccinated"];
    $description = $_POST["description"];
    $picture = file_upload($_FILES["photo"]);
    $uploadError = "";

    $mysql = "INSERT INTO animal (name, breed, size, age, location, vaccinated, description, photo)
    VALUES ('$name', '$breed', '$size', '$age', '$location', '$vaccinated', '$description', '$picture->fileName')";

if (mysqli_query($connect, $mysql) === true) {
    $class = "success";
    $message = "The entry below was successfully created <br>
        <table class='table text-center'><tr>
        <td><b>Name</b></td>
        <td><b>Breed</b></td>
        <td><b>Size</b></td>
        <td><b>Age</b></td>
        <td><b>Location</b></td>
        </tr><tr>
        <td> $name </td>
        <td> $breed </td>
        <td> $size </td>
        <td> $age </td>
        <td> $location </td>
        </tr></table><hr>";
    $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
} else {
    $class = "danger";
    $message = "Error while creating record. Try again: <br>" . $connect->error;
    $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
}
mysqli_close($connect);
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
        .request-container {
            width: 30%;
        }

        .btn {
            width: 80px;
        }
    </style>
</head>
<body>
<div class="container text-center request-container mt-5">
        <div class="alert alert-<?= $class ?>" role="alert">
            <p class="fs-3"><?php echo ($message) ?? ''; ?></p>
            <p class="fs-4"><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../../dashboard.php'><button class="btn btn-success" type='button'>Ok</button></a>
        </div>
    </div>
</body>
</html>