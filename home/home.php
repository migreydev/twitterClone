<?php
require_once "../connection/connection.php";
session_start();

$connect = connection();
$idUser = $_SESSION['usuario']["id"];

$sql = "SELECT *,
            (SELECT username
            FROM social_network.users 
            WHERE users.id = publications.userId) AS username
        FROM social_network.publications
        WHERE userId = '2'";
$query = mysqli_query($connect, $sql);
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
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="card-title text-center">User Information</h1>
                    <div class="alert alert-info">
                        <?php
                        if (isset($_SESSION["usuario"])) {
                            $username = $_SESSION["usuario"]["username"];
                            $email = $_SESSION["usuario"]["email"];
                            $description = $_SESSION["usuario"]["description"];

                            ?> <b> <?php echo "Username: $username"; ?> </b><br>
                            <b> <?php echo "Email: $email"; ?> </b><br>
                            <b> <?php echo "Description: $description"; ?> </b><br>
                        <?php
                        }else {
                            header("Location: ../index.php");
                        }
                        ?>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="card-title text-center">Add Tweet</h2>
                            <form action="../home/process_home.php" method="POST">
                                <div class="mb-3">
                                    <label for="tweet" class="form-label">Tweet</label>
                                    <textarea class="form-control alert alert-info" id="tweet" name="tweet" rows="3" required></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-4"> 
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title text-center">Twitter Board</h2>
                    <div class="alert alert-info">
                    <?php while ($row = mysqli_fetch_array($query)): ?>
                    <div class="border border-dark p-3 mb-3">
                        <h4 class="text-center"> <a href=""> <?= $row['username'] ?></a></h4>
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