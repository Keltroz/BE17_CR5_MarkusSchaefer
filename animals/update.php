<?php

require_once '../components/db_connect.php';

session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["admin"])) {
    header("Location: ../index.php");
    exit;
}
if (isset($_SESSION["user"])) {
    header("Location: ../index.php");
    exit;
}

if ($_GET['id']) {
    $id = $_GET['id'];
    $mysql = "SELECT * FROM animal WHERE animal_id = {$id}";
    $result = mysqli_query($connect, $mysql);
    if (mysqli_num_rows($result) == 1) {
        $data = mysqli_fetch_assoc($result);
        $name = $data["name"];
        $breed = $data["breed"];
        $size = $data["size"];
        $age = $data["age"];
        $location = $data["location"];
        $vaccinated = $data["vaccinated"];
        $description = $data["description"];
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
<html>

<head>
    <title>Edit Product</title>
    <?php require_once '../components/boot.php' ?>
    <style type="text/css">

        .dash-container {
            margin: 0 auto;
            width: 60%;
        }

        .btn {
            width: 80px;
        }
    </style>
</head>

<body>
    <!-- <fieldset>
        <legend class='h2'>Update request <img class='img-thumbnail rounded-circle' src='../pictures/<?= $picture ?>' alt="<?= $name ?>"></legend>
        <form action="actions/a_update.php" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <th>Name</th>
                    <td><input class="form-control" type="text" name="name" placeholder="Name" value="<?= $name ?>" /></td>
                </tr>
                <tr>
                    <th>Breed</th>
                    <td><input class="form-control" type="text" name="breed" step="any" placeholder="Breed" value="<?= $breed ?>" /></td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class="form-control" type="file" name="picture" /></td>
                </tr>
                <tr>
                    <th>Supplier</th>
                    <td><select class="form-select" name="supplier">
                            <?= $suplList ?>

                        </select></td>
                </tr>
                <tr>
                    <input type="hidden" name="id" value="<?= $data['animal_id'] ?>" />
                    <input type="hidden" name="picture" value="<?= $data['photo'] ?>" />
                    <td><button class="btn btn-success" type="submit">Save Changes</button></td>
                    <td><a href="../dashboard.php" class="btn btn-warning" type="button">Back</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset> -->
    <div class="mt-5 dash-container">
        <div class="row">
            <p class='h2 text-center mb-3'>Update Entry</p>
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
                                            <td><button class='btn btn-success' type="submit" style="float: right">Update</button></td>
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