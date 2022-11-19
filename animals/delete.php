<?php

session_start();

require_once "../components/db_connect.php";

if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location: ../index.php");
    exit;
}
if (isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit;
}

if ($_GET["id"]) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM animal WHERE animal_id = {$id}";
    $result = mysqli_query($connect, $sql);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        $name = $data["name"];
        $breed = $data["breed"];
        $picture = $data["photo"];
    } else {
        header("location: error.php");
    }
    mysqli_close($connect);
} else {
    header("location: error.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Review 5</title>
    <?php require_once '../components/boot.php' ?>

    <style type="text/CSS">
        fieldset {
            margin: 2% auto;
            width: 25%;
        }

        .picture {
            margin: 0 auto;
            width: 700px;
            height: 500px;
            min-width: 100%;
            min-height: 100%;
            max-width: 100%;
            max-height: 100%;
        }

        .btn {
            width: 100px;
        }
    </style>

</head>

<body>
    <fieldset class="text-center">
        <table class="mt-3">
            <tr>
                <td class="fs-3 fw-bold">
                    <?= $name ?>
                </td>
            </tr>
            <tr>
                <td>
                    <img class='picture rounded mt-4 mb-4' src='../pictures/<?= $picture ?>' alt="<?= $name ?>">
                </td>
            </tr>
        </table>

        <h2 class="mt-4 mb-5">Do you really want to delete this animal?</h2>
        <form action="actions/a_delete.php" method="post">
            <input type="hidden" name="animal_id" value="<?= $id ?>" />
            <input type="hidden" name="photo" value="<?= $picture ?>" />
            <button class="btn btn-primary" type="button" onclick="window.location.href='../dashboard.php'" style="float: left;">No</button>
            <button class="btn btn-danger" type="submit" style="float: right;">Yes</button>
        </form>
    </fieldset>
</body>

</html>