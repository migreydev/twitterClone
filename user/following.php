<?php

require_once "../connection/connection.php";
session_start();

$connect = connection();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../index.php");
}

$userID = $_SESSION['usuario']['id'];
$userIdFollow = $_POST['idUserFollow'];


$sql = "INSERT INTO follows (users_id, userToFollowId) VALUES ('$userID', '$userIdFollow')";
$query = mysqli_query($connect, $sql);

header("Location: ../home/home.php");

?>