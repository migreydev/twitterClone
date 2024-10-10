<?php

require_once "../connection/connection.php";
session_start();

$connect = connection();

$userID = $_SESSION['usuario']['id'];
$userIdFollow = $_POST['idUserFollow'];


$sql = "DELETE FROM follows WHERE users_id = $userID AND userToFollowId = $userIdFollow";
$query = mysqli_query($connect, $sql);

header("Location: ../home/home.php");


?>