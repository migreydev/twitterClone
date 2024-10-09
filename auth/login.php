<?php
require_once "../connection/connection.php";
session_start();

$connect = connection();

if (isset($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
}

$sql = "SELECT * FROM users WHERE email = '$email'";
$res = mysqli_query($connect, $sql);

if ($res && mysqli_num_rows($res) == 1) {
    $user = mysqli_fetch_assoc($res);

    if (password_verify($password, $user["password"])) {
        $_SESSION["usuario"] = $user;
        header("Location: ../home/home.php");
    } else {
        $_SESSION["error"] = "Credenciales erroneas";
        header("Location: ../index.php");
    }
} else {
    $_SESSION["error"] = "Credenciales erroneas";
    header("Location: ../index.php");
}
?>
