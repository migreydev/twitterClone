<?php
require_once "../connection/connection.php";
session_start();

$connect = connection();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../index.php");
}
//Obtiene el id del usuario actual
$usuer = $_SESSION["usuario"]["id"];

// Consulta para obtener usuarios con los que se ha tenido conversaciones
$sql = "SELECT DISTINCT 
    (CASE 
        WHEN senderId = $usuer THEN receiverId 
        ELSE senderId 
    END) AS otherUserId,
    (SELECT username 
     FROM social_network.users 
     WHERE id = 
        (CASE 
            WHEN senderId = $usuer THEN receiverId 
            ELSE senderId 
        END)
    ) AS username
FROM social_network.private_messages 
WHERE receiverId = $usuer OR senderId = $usuer;";

$query = mysqli_query($connect, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
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
                    <h2 class="card-title text-center">Messages</h2>
                    <div class="alert alert-info">
                        <?php if (mysqli_num_rows($query) > 0): ?>
                            <?php while ($data = mysqli_fetch_assoc($query)): ?>
                                <form action="../functionalities/conversation.php" method="POST">
                                    <input type="hidden" name="receiverId" value="<?= $data['otherUserId'] ?>">
                                    <button type="submit" class="btn btn-link text-decoration-none">
                                        <b><?php echo htmlspecialchars($data['username']); ?></b><br>
                                    </button>
                                </form>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <b>No messages</b><br>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title text-center">Add Message</h2>
                    <form action="../functionalities/process_messages.php" method="POST">
                        <div class="mb-1">
                            <label for="username" class="form-label">User</label>
                            <div class="input-group">
                                <input type="text" class="form-control alert alert-info" id="username" name="username" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control alert alert-info" id="message" name="message" rows="3" required></textarea>
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
</body>
</html>

