<?php
require_once "../connection/connection.php";
session_start();

$connect = connection();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../index.php");
}

$query = "SELECT *,
    (SELECT username 
     FROM social_network.users
     WHERE users.id = publications.userId) AS username
    FROM publications";
$query = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter Board</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-info" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand text-dark" href="../home/home.php"><b>Twitter Clone</b></a>
        <a class="nav-link text-dark me-3" href="../home/home.php">Home</a>
        <a class="nav-link text-dark me-3" href="../user/board.php">Twitter Board</a>
        <a class="nav-link text-dark me-3" href="../user/myProfile.php">My Profile</a>
        <a class="nav-link text-dark" href="../functionalities/messages.php">Messages</a>
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
        <div class="col-md-8"> 
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title text-center">Twitter Board</h2>
                    <div class="alert alert-info">
                        <?php while ($row = mysqli_fetch_array($query)): ?>
                        <div class="border border-dark p-3 mb-3">
                            <form action="../user/view.php" method="POST">
                                <input type="hidden" name="userIdForm" value="<?= $row['userId'] ?>">
                                <h4 class="text-center">
                                    <button type="submit" class="btn btn-link"><?= $row['username'] ?></button>
                                </h4>
                            </form>
                            <p class="text-center"><?= $row['text'] ?></p>
                            <small class="text-center"><?= $row['createDate'] ?></small>
                        </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
