<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh; background-color: #f8f9fa;">

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
                            <b> <?php echo "description: $description"; ?> </b><br>
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
                    <p class="text-center"></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</body>
</html>
