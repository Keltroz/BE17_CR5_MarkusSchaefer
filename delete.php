<?php

session_start();

require_once 'components/db_connect.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit;
}
if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit;
}
//initial bootstrap class for the confirmation message
$class = 'd-none';
//the GET method will show the info from the user to be deleted
if ($_GET['id']) {
    $id = $_GET['id'];
    $mysql = "SELECT * FROM user WHERE user_id = {$id}";
    $result = mysqli_query($connect, $mysql);
    $data = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        $fname = $data['first_name'];
        $lname = $data['last_name'];
        $email = $data['email'];
        $status = $data['status'];
        $picture = $data['picture'];
    }
}
//the POST method will delete the user permanently
if ($_POST) {
    $id = $_POST['id'];
    $picture = $_POST['picture'];
    ($picture == "avatar.png") ?: unlink("pictures/$picture");

    $sql = "DELETE FROM user WHERE user_id = {$id}";
    if ($connect->query($sql) === TRUE) {
        $class = "alert alert-success";
        $message = "Successfully Deleted!";
        header("refresh:1;url=dashboard.php");
    } else {
        $class = "alert alert-danger";
        $message = "The entry was not deleted due to: <br>" . $connect->error;
    }
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <?php require_once 'components/boot.php' ?>
    <style type="text/css">
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 25%;
        }

        .btn {
            width: 80px;
        }

        td {
            text-align: center;
        }

        .alert-container {
            width: 20%;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="<?= $class; ?> alert-container mt-5" role="alert">
        <p class="text-center pt-2"><?= ($message) ?? ''; ?></p>
    </div>
    <fieldset>
        <h2 class="mb-5 text-center">Are you sure you want to delete this user?</h2>
        <div class="card pt-3 pe-3 pb-3 ps-3">
            <div class="row">
                <div class="col-4">
                    <img class='rounded-circle' src='pictures/<?= $picture ?>' alt="<?= $fname ?>" style="width: 200px; height: 200px">
                </div>
                <div class="col-8">
                    <table class="table table-light mt-4">
                        <tr>
                            <th class="bg-warning">
                                <h5><b>Name</b></h5>
                            </th>
                            <td>
                                <?= "$fname $lname" ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-warning">
                                <h5><b>Email</b></h5>
                            </th>
                            <td>
                                <?= $email ?>
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-warning">
                                <h5><b>Status</b></h5>
                            </th>
                            <td>
                                <?= $status ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        </div>

        <form method="post">
            <input type="hidden" name="id" value="<?= $id ?>" />
            <input type="hidden" name="picture" value="<?= $picture ?>" />
            <a href="dashboard.php"><button class="btn btn-primary mt-5" type="button">No</button></a>
            <button class="btn btn-danger mt-5" type="submit" style="float: right">Yes</button>
        </form>
    </fieldset>
</body>

</html>