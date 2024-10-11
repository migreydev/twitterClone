<?php
require_once "../connection/connection.php";
session_start();

$connect = connection();
$userIdForm = '';

if(isset($_POST['userIdForm'])){
    $userIdForm = $_POST['userIdForm'];
}

$sql = "SELECT *,
            (SELECT username
            FROM social_network.users 
            WHERE users.id = publications.userId) AS username
        FROM social_network.publications
        WHERE userId = '$userIdForm'";

$query = mysqli_query($connect, $sql);


$sqlUser = "SELECT *
            FROM social_network.users
            WHERE id = '$userIdForm'";

$otherQuery = mysqli_query($connect, $sqlUser);

$userId = $_SESSION['usuario']['id'];

$sqlFollow = "SELECT * 
            FROM social_network.follows
            WHERE users_id = $userId";

$queryFollow = mysqli_query($connect, $sqlFollow);

$sqlCountFollowing = "SELECT COUNT(users_id) AS Following
                    FROM social_network.follows 
                    WHERE users_id =  $userId";

$queryCountFollowing = mysqli_query($connect, $sqlCountFollowing);
$countFollowingData = mysqli_fetch_assoc($queryCountFollowing);

$sqlCountFollowers = "SELECT COUNT(userToFollowId) as Followers
                    FROM social_network.follows 
                    WHERE users_id =  $userId";

$queryCountFollowers = mysqli_query($connect, $sqlCountFollowers);
$countFollowersData = mysqli_fetch_assoc($queryCountFollowers);
        
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
<div class="container mt-5">
    <div class="row">
        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title text-center">User Information</h2>
                    <div class="alert alert-info">
                        <?php 
                        if(isset($_SESSION["usuario"])) {

                            mysqli_data_seek($otherQuery, 0);
                            $otherRow = mysqli_fetch_array($otherQuery);
                            
                            if ($otherRow): ?>
                                <?php $username = $otherRow['username'];
                                    $email = $otherRow['email'];
                                    $description = $otherRow['description'];

                                ?> <b> <?php echo "Username: $username"; ?> </b><br>
                                <b> <?php echo "Email: $email"; ?> </b><br>
                                <b> <?php echo "Description: $description"; ?> </b><br>
                            <?php endif ?>
                        <?php
                        
                        }else {
                            header("Location: ../index.php");
                        }
                        ?>
                    </div>
                    <?php

                    if(isset($_SESSION["usuario"])) {

                        $userUsername = $_SESSION["usuario"]['username'];
                        mysqli_data_seek($otherQuery, 0);
                        $UserQuery = mysqli_fetch_array($otherQuery);

                        if ($UserQuery) { 
                            if ($userUsername !== $UserQuery['username'] && mysqli_num_rows($queryFollow) !== 1) { ?>

                                <form action="../user/following.php" method="POST">
                                <input type="hidden" name="idUserFollow" value="<?= $UserQuery['id'] ?>">
                                    <button class="btn btn-outline-primary" type="submit" name="buttonFollow">Follow</button>
                                </form>
                            <?php 
                            }

                            if ($userUsername !== $UserQuery['username'] && mysqli_num_rows($queryFollow) === 1) { ?>

                                <form action="../user/unfollow.php" method="POST">
                                <input type="hidden" name="idUserFollow" value="<?= $UserQuery['id'] ?>">
                                    <button class="btn btn-outline-danger" type="submit" name="buttonFollow">Unfollow</button>
                                </form>

                                <?php 
                            }
                        }
                    }    
                    ?>
                    <form action="./listFollowing.php" method="POST">
                        <input type="hidden" name="userID" value="<?=$userIdForm ?>">
                        <p>Following: <button class="btn btn-link" type="submit"><?= $countFollowingData['Following'] ?> </button> </p>
                    </form>
                    <form action="./listFollowers.php" method="POST">
                        <input type="hidden" name="userID" value="<?=$userIdForm ?>">
                        <p>Followers: <button class="btn btn-link" type="submit"><?= $countFollowersData['Followers'] ?>  </button> </p>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7"> 
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title text-center">Twitter Board</h2>
                    <div class="alert alert-info">
                    <?php 
                    mysqli_data_seek($query, 0);
                    
                    while ($row = mysqli_fetch_array($query)): ?>
                    <div class="border border-dark p-3 mb-3">
                        <form action="../user/view.php" method=POST>
                            <input type="hidden" name="userIdForm" value="<?= $row['userId'] ?>">
                            <h4 class="text-center"> <button type="submit" class="btn btn-link"> <?= $row['username'] ?></a></h4>
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