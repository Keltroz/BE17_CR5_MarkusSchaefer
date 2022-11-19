<?php

session_start();

require_once "../components/db_connect.php";

if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"]) || isset($_SESSION["user"])) {
    header("Location: ../index.php");
    exit;
}

$mysql = "SELECT * FROM animal";
$result = mysqli_query($connect, $mysql);


mysqli_close($connect);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coode Review 5</title>
    <?php require_once "../components/boot.php" ?>

    <style type="text/CSS">
        .dash-container {
            margin: 0 auto;
            width: 60%;
        }
    </style>
</head>

<body>

    <div class="mt-5 dash-container">
        <div class="row">
            <p class='h2 text-center mb-3'>Add Animal</p>
            <div class="col-4">
                <img src="../pictures/admin_avatar.png" alt="" style="width: 500px">
            </div>
            <div class="col-8 mt-2 ms5">
                <table class='table align-middle bg-white'>
                    <thead class='table-light'>
                        <tr>
                            <fieldset>
                                <form action="actions/a_create.php" method="post" enctype="multipart/form-data">
                                    <table class='table'>
                                        <tr>
                                            <th>Name</th>
                                            <td><input class='form-control' type="text" name="name" placeholder="Name" /></td>
                                        </tr>
                                        <tr>
                                            <th>Breed</th>
                                            <td><input class='form-control' type="text" name="breed" placeholder="Breed" step="any" /></td>
                                        </tr>
                                        <tr>
                                            <th>Size</th>
                                            <td><input class='form-control' type="text" name="size" placeholder="Size" step="any" /></td>
                                        </tr>
                                        <tr>
                                            <th>Age</th>
                                            <td><input class='form-control' type="number" name="age" placeholder="Age" step="any" /></td>
                                        </tr>
                                        <tr>
                                            <th>Location</th>
                                            <td><input class='form-control' type="text" name="location" placeholder="Location" step="any" /></td>
                                        </tr>
                                        <tr>
                                            <th>Vaccinated</th>
                                            <td>
                                                <select name="vaccinated">
                                                    <option value="none">Yes</option>
                                                    <option value="none">No</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td><input class='form-control' type="text" name="description" placeholder="Description" step="any"/></td>
                                        </tr>
                                        <tr>
                                            <th>Picture</th>
                                            <td><input class='form-control' type="file" name="photo" /></td>
                                        </tr>
                                        <tr>
                                            <td><a href="../dashboard.php"><button class='btn btn-primary' type="button">Back</button></a></td>
                                            <td><button class='btn btn-success' type="submit" style="float: right">Add Animal</button></td>
                                        </tr>
                                    </table>
                                </form>
                            </fieldset>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    
</body>

</html>