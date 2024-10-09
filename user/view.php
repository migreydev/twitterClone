<?php
require_once "../connection/connection.php";
session_start();

$connect = connection();

if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php");
}


$user = $_SESSION['usuario']['username'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-info" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand text-dark" href="../home/home.php"><b>Twitter Clone</b></a>
        <a class="nav-link text-dark" href="../home/home.php">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-dark" href="../auth/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 alert alert-info">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <?php if (isset($_SESSION["usuario"])) { ?>
                        <h5 class="card-title">Profile of <?php echo ($user); ?></h5>
                        <p class="card-text">Email: <?php echo ($_SESSION["usuario"]["email"]); ?></p>
                        <p class="card-text">Description: <?php echo ($_SESSION["usuario"]["description"]); ?></p>
                        <p class="card-text">Account creation date: <?php echo ($_SESSION["usuario"]["createDate"]); ?></p>
                    <?php } else { ?>
                        <p class="card-text">No user information available.</p>
                    <?php } ?>
                </div>
            </div>
            <button class="btn btn-outline-primary">Follow</button>
        </div>
    </div>
</div>
</body>
</html>