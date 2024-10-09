<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh; background-color: #f8f9fa;">

    <div class="card border border-info" style="width: 100%; max-width: 600px;">
        <div class="card-body">
            <h1 class="card-title text-center text-info">Register</h1>
            <?php if(isset($_SESSION['error'])):  ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error']; ?>
                </div>
                <?php 
                    unset($_SESSION['error']);
                ?>
            <?php endif; ?>
            <form action="./process_register.php" method="POST" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="validationTooltipUsername">Username</label>
                    <div class="input-group">
                        <div class="input-group-text">@</div>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" aria-describedby="validationTooltipUsernamePrepend" required>
                        <div class="invalid-tooltip">
                            Please choose a unique and valid username.
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="validationTooltip01">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    <div class="invalid-tooltip">
                        Please provide a valid email.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="validationTooltip02">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <div class="invalid-tooltip">
                        Please provide a password.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description">Description</label>
                    <input type="description" class="form-control" id="description" name="description" placeholder="Description" required>
                    <div class="invalid-tooltip">
                        Please provide a description.
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-info" type="submit">Register</button>
                </div>
                <div class="text-center mt-3">
                    <a href="../index.php" class="text text-info">Back to login</a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
