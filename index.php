<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Review 5</title>
    <?php require_once "components/boot.php" ?>
</head>

<style type="text/CSS">
    .btn-secondary {
        text-align: center;
        margin: auto;
        width: 20%;
    }
</style>

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

    <div class="secondary">
        <h1>Pets available</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="pictures/<?= $pic ?>" alt="avatar" class="rounded-circle img-fluid">


                    </div>

                </div>

            </div>
        </div>

    </div>
</body>

</html>