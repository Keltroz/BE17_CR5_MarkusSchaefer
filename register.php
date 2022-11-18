<?php

require_once "components/db_connect.php";
require_once "components/file_upload.php";

$error = false;

$fname = $lname = $address = $phoneNumber = $email = $password = $picture = "";
$fnameError = $lnameError = $addressError = $phoneNumberError = $emailError = $passwordError = $pictureError = "";

if (isset($_POST['btn-signup'])) {
    $fname = trim($_POST['fname']);
    $fname = strip_tags($_POST['fname']);
    $fname = htmlspecialchars($_POST['fname']);

    $lname = trim($_POST['lname']);
    $lname = strip_tags($_POST['lname']);
    $lname = htmlspecialchars($_POST['lname']);

    $address = trim($_POST['address']);
    $address = strip_tags($_POST['address']);
    $address = htmlspecialchars($_POST['address']);

    $phoneNumber = trim($_POST['phone_number']);
    $phoneNumber = strip_tags($_POST['phone_number']);
    $phoneNumber = htmlspecialchars($_POST['phone_number']);

    $email = trim($_POST['email']);
    $email = strip_tags($_POST['email']);
    $email = htmlspecialchars($_POST['email']);

    $password = trim($_POST['password']);
    $password = strip_tags($_POST['password']);
    $password = htmlspecialchars($_POST['password']);

    $uploadError = "";
    $picture = file_upload($_FILES['picture']);

    if (empty($fname)) {
        $error = true;
        $fnameError = "Please enter your name";
    } elseif (strlen($fname) < 2) {
        $error = true;
        $fnameError = "Name must have at least 2 characters";
    } elseif (!preg_match("/^[a-zA-Z]+$/", $fname)) {
        $error = true;
        $fnameError = "Name must contain only letter and no spaces";
    }

    if (empty($lname)) {
        $error = true;
        $lnameError = "Please enter your surname";
    } elseif (strlen($lname) < 3) {
        $error = true;
        $lnameError = "Surname must have at least 3 characters";
    } elseif (!preg_match("/^[a-zA-Z]+$/", $lname)) {
        $error = true;
        $lnameError = "Surname must contain only letter and no spaces";
    }

    if (empty($address)) {
        $error = true;
        $addressError = "Please enter your address";
    }

    if (empty($phoneNumber)) {
        $error = true;
        $phoneNumberError = "Please enter your phone number";
    } elseif (strlen($phoneNumber) < 7) {
        $error = true;
        $phoneNumberError = "Please enter a valid phone number";
    } elseif (!preg_match("/^[0-9+]+$/", $phoneNumber)) {
        $error = true;
        $phoneNumberError = "Phone number must contain only numbers and no spaces";
    }

    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter a valid email";
    } else {
        $sql = "SELECT email FROM user WHERE email = '$email'";
        $result = mysqli_query($connect, $sql);
        $count = mysqli_num_rows($result);
        if ($count != 0) {
            $error = true;
            $emailError = "Email already exists";
        }
    }

    if (empty($password)) {
        $error = true;
        $passwordError = "Please enter a password";
    } elseif (strlen($password) < 8) {
        $error = true;
        $passwordError = "Password must have at least 8 characters";
    }

    $passwordHash = hash('sha256', $password);

    if (!$error) {
        $sql = "INSERT INTO user (first_name, last_name, address, phone_number, email, picture)
        VALUES ('$fname', '$lname', '$address', '$phoneNumber', '$email', '$picture->fileName')";

        $result2 = mysqli_query($connect, $sql);

        if ($result2) {
            $errType = "success";
            $errMSG = "Successfully registered, you may login now";
            $uploadError = ($picture->errorr != 0) ? $picture->ErrorrMessage : "";
        } else {
            $errType = "danger";
            $errMSG = "Something went wrong, try again later...";
            $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : "";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Review 5</title>
    <?php require_once "components/boot.php" ?>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Shelter</a>
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
                            <li><a class="dropdown-item" href="./animals/index.php">All</a></li>
                            <li><a class="dropdown-item" href="./animals/senior.php">Senior (8+ years)</a></li>
                        </ul>
                    </li>
                    <a class="nav-link active" href="login.php">Login</a>
                </div>
            </div>
        </div>
    </nav>
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
                                        <input class='form-control' type="text" name="phone_number" placeholder="Phone number" value="<?php echo $address ?>" />
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
                                        <input type="email" name="address" class="form-control" placeholder="Enter Your Address" maxlength="150" value="<?php echo $address ?>" />
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
    </div>
</body>

</html>