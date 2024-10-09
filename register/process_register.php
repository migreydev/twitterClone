<?php
require_once "../connection/connection.php";
session_start();

$connect = connection();

if (isset($_POST)) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $description = $_POST['description'];
}

$validateUsername = false;
$validateEmail = false;
$validatePassword = false;
$validateDescription = false;

$errorMessage = '';

if(empty($username)){
    $errorMessage = 'Username cannot be empty';
    header("Location: register.php");
}else {
    $validateUsername = true;
}

if(empty($email)){
    $errorMessage = 'Email cannot be empty';
    header("Location: register.php");
}else {
    $validateEmail = true;
}

if(empty($password)){
    $errorMessage = 'Password cannot be empty';
    header("Location: register.php");
}else {
    $validatePassword = true;
}

if(empty($description)){
    $errorMessage = 'Description cannot be empty';
    header("Location: register.php");
}else {
    $validateDescription = true;
}

if (!empty($errorMessage)) {
    $_SESSION['error'] = $errorMessage;
    header("Location: register.php");
}

$id = 0;
$passSegura = password_hash($password, PASSWORD_BCRYPT);
$date = date('Y-m-d');


if($validateUsername && $validateEmail && $validatePassword && $validateDescription){

    $sqlEmail = "SELECT * FROM users WHERE email = '$email' ";
    $res = mysqli_query($connect, $sqlEmail);

    if ($res && mysqli_num_rows($res) == 1) {

        $_SESSION['error'] = 'Error, the user already exists';
        header("Location: register.php");

    }else {

        $sql = "INSERT INTO users (id, username, email, password, description, createDate) VALUES ('$id', '$username', '$email', '$passSegura', '$description', '$date')";
        $registro = mysqli_query($connect, $sql);
        $_SESSION['completado'] = 'The credentials have been created ';
        header("Location: ../index.php");
    }

}else {
    $_SESSION['error'] = $errorMessage . '. Error creating user, try again.';
    header("Location: register.php");
}

?>