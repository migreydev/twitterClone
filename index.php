<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Clone Twitter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh; background-color: #f8f9fa;">

    <div class="card border border-info" style="width: 100%; max-width: 400px;">
    <h1 class="text-center text-info">Twitter Clone</h1>
        <div class="card-body">
        <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error']; ?>
                </div>
                <?php 
                    unset($_SESSION['error']);
                ?>
        <?php endif; ?>

            <form action="./auth/login.php" method="POST">
                <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control" required />
                    <label class="form-label" for="email">Email</label>
                </div>
                <div class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control" required />
                    <label class="form-label" for="password">Password</label>
                </div>
                <button type="submit" class="btn btn-info btn-block mb-4" name="submit">Sign in</button>
                <div class="text-center">
                    <p >Create a new account <a href="./register/register.php" class="text text-info">Register</a></p>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
