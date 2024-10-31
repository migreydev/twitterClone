<?php
require_once "../connection/connection.php";
session_start();

if(!$_SESSION['usuario']){
    header("Location: ../index.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-info" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand text-dark" href="../home/home.php"><b>Twitter Clone</b></a>
        <a class="nav-link text-dark me-3" href="../home/home.php">Home</a>
        <a class="nav-link text-dark me-3" href="../user/board.php">Twitter Board</a>
        <a class="nav-link text-dark" href="../user/myProfile.php">My Profile</a>
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
<div class="d-flex align-items-center justify-content-center flex-grow-1">
    <div class="card border border-info" style="width: 100%; max-width: 600px;">
        <div class="card-body">
            <h1 class="card-title text-center text-info">Edit Profile <?=$_SESSION['usuario']['username'] ?></h1>
            <form action="./process_edit.php" method="POST">
                <div class="mb-3">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?= $_SESSION['usuario']['description'] ?>" required>
                    <div class="invalid-tooltip">
                        Please provide a description.
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-warning" type="submit">Edit Profile</button>
                </div>
                <div class="text-center mt-3">
                    <a href="../home/home.php" class="text text-info">Back to home</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>