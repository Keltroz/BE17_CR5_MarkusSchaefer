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
        <table class='table w-50'><tr>
        <td> $name </td>
        <td> $breed </td>
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
</head>
<body>
<div class="container">
        <div class="mt-3 mb-3">
            <h1>Create request response</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../../index.php'><button class="btn btn-primary" type='button'>Home</button></a>
        </div>
    </div>
</body>
</html>