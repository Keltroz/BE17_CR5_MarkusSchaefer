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
            width: 70%;
        }
    </style>
</head>

<body>
    <!-- <fieldset>
        <legend class='h2'>Add Product</legend>
        <form action="actions/a_create.php" method="post" enctype="multipart/form-data">
            <table class='table'>
                <tr>
                    <th>Name</th>
                    <td><input class='form-control' type="text" name="name" placeholder="Product Name" /></td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td><input class='form-control' type="number" name="price" placeholder="Price" step="any" /></td>
                </tr>
                <tr>
                    <th>Picture</th>
                    <td><input class='form-control' type="file" name="picture" /></td>
                </tr>
                <tr>
                    <th>Supplier</th>
                    <td>
                        <select name="supplier">
                            <option value="none">Undefined</option>
                            <?= $suppliers ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><button class='btn btn-primary' type="submit">Add Animal</button></td>
                    <td><a href="index.php"><button class='btn btn-warning' type="button">Home</button></a></td>
                </tr>
            </table>
        </form>
    </fieldset>

    <div class="container py-5 h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-12 col-lg-9 col-xl-7">
                <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body p-4 p-md-5">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off" enctype="multipart/form-data">
                            <?php
                            if (isset($errMSG)) {
                            ?>
                                <div class="alert alert-<?php echo $errTyp ?>">
                                    <p><?php echo $errMSG; ?></p>
                                    <p><?php echo $uploadError; ?></p>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" name="fname" class="form-control" placeholder="First name" maxlength="50" value="<?php echo $fname ?>" />
                                        <span class="text-danger"> <?php echo $fnameError; ?> </span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input type="text" name="lname" class="form-control" placeholder="Surname" maxlength="50" value="<?php echo $lname ?>" />
                                        <span class="text-danger"> <?php echo $lnameError; ?> </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4 d-flex align-items-center">
                                    <div class="form-outline datepicker w-100">
                                        <input class='form-control' type="text" name="phone_number" placeholder="Phone number" value="<?php echo $phoneNumber ?>" />
                                        <span class="text-danger"> <?php echo $phoneNumberError; ?> </span>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="form-outline">
                                        <input class='form-control' type="file" name="picture">
                                        <span class="text-danger"> <?php echo $pictureError; ?> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-2 pb-2">
                                    <div class="form-outline">
                                        <input type="text" name="address" class="form-control" placeholder="Enter Your Address" maxlength="150" value="<?php echo $address ?>" />
                                        <span class="text-danger"> <?php echo $addressError; ?> </span>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-2 pb-2">
                                    <div class="form-outline">
                                        <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="50" value="<?php echo $email ?>" />
                                        <span class="text-danger"> <?php echo $emailError; ?> </span>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-4 pb-2">
                                    <div class="form-outline">
                                        <input type="password" name="password" class="form-control" placeholder="Enter Password" maxlength="25" />
                                        <span class="text-danger"> <?php echo $passwordError; ?> </span>
                                    </div>

                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" style="width:100%" name="btn-signup">Register</button>
                            </div>
                            <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="login.php" class="fw-bold text-body"><u>Login here</u></a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="mt-5 dash-container">
        <div class="row">
            <p class='h2 text-center mb-3'>Add Animal</p>
            <div class="col-4">
                <img src="../pictures/admin_avatar.png" alt="" style="width: 600px">
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
                                            <td><button class='btn btn-primary' type="submit">Add Animal</button></td>
                                            <td><a href="index.php"><button class='btn btn-warning' type="button">Home</button></a></td>
                                        </tr>
                                    </table>
                                </form>
                            </fieldset>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>