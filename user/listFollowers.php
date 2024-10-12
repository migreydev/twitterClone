<?php
require_once "../connection/connection.php";
session_start();

$connect = connection();

$idUser = $_POST['userID'];

$sql = "SELECT users_id,
        (SELECT username
        FROM social_network.users 
        WHERE users.id = follows.userToFollowId) AS user,
        (SELECT username
        FROM social_network.users 
        WHERE users.id = follows.users_id) AS username
FROM social_network.follows 
WHERE userToFollowId = $idUser";

$query = mysqli_query($connect, $sql);
$usernameCount = mysqli_fetch_assoc($query);

$slqUsername = "SELECT username
                FROM users
                WHERE id = $idUser";

$queryUser =  mysqli_query($connect, $slqUsername);
$usernameQuery = mysqli_fetch_assoc($queryUser);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Followers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-info" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand text-dark" href="../home/home.php"><b>Twitter Clone</b></a>
        <a class="nav-link text-dark me-3" href="../home/home.php">Home</a>
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


<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-7"> 
        <div class="card mb-4"> 
            <div class="card-body">
                <h2 class="card-title text-center">Followers <?= $usernameQuery['username']?> </h2>
                <div class="alert alert-info">
                    <?php   
                    mysqli_data_seek($query, 0);
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_array($query)): ?>
                            <div class="border border-dark p-3 mb-3">
                                <form action="../user/view.php" method=POST>
                                    <h4 class="text-center"> 
                                        <button type="submit" class="btn btn-link"> <?= $row['username'] ?></button>
                                    </h4>
                                </form>
                            </div>
                        <?php endwhile;
                    }else { ?>
                    <h4 class="text-center"> 
                        <p>Without followers</p>
                    </h4>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>