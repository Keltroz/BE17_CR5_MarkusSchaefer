<?php

session_start();

require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';

if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location: ../../index.php");
    exit;
}
if (isset($_SESSION["user"])) {
    header("Location: ../../index.php");
    exit;
}

if ($_POST) {
    $id = $_POST['id'];
    $name = $_POST["name"];
    $breed = $_POST["breed"];
    $size = $_POST["size"];
    $age = $_POST["age"];
    $location = $_POST["location"];
    $vaccinated = $_POST["vaccinated"];
    $description = $_POST["description"];
    //variable for upload pictures errors is initialised
    $uploadError = '';

    $picture = file_upload($_FILES["photo"], "animal"); //file_upload() called  
    if ($picture->error === 0) {
        ($_POST["photo"] == "animal_avatar.png") ?: unlink("../../pictures/$_POST[photo]");
        $sql = "UPDATE animal SET name = '$name', breed = '$breed', size = '$size', age = $age, location = '$location', vaccinated = '$vaccinated', description = '$description', photo = '$picture->fileName' WHERE animal_id = {$id}";
    } else {
        $sql = "UPDATE animal SET name = '$name', breed = '$breed', size = '$size', age = $age, location = '$location', vaccinated = '$vaccinated', description = '$description' WHERE animal_id = {$id}";
    }
    if (mysqli_query($connect, $sql) === TRUE) {
        $class = "success";
        $message = "The entry was successfully updated";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    } else {
        $class = "danger";
        $message = "Error while updating entry : <br>" . mysqli_connect_error();
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
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
    <title>Update</title>
    <?php require_once "../../components/boot.php" ?>

    <style type="text/CSS">
        .alert-container {
            width: 30%;
        }
            
        .btn {
            width: 80px;
        }
    </style>

</head>

<body>
    <div class="container alert-container text-center mt-5">
        <div class="alert alert-<?= $class ?>" role="alert">
            <p class="fs-3"><?= ($message) ?? ''; ?></p>
            <p class="fs-4"><?= ($uploadError) ?? ''; ?></p>
            <a href="../../dashboard.php" class="btn btn-success" type="button">Ok</button></a>
        </div>
    </div>
</body>

</html>