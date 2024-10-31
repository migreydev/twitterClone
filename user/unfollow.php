<?php

require_once "../connection/connection.php";
session_start();

$connect = connection();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../index.php");
}

$userID = $_SESSION['usuario']['id'];
$userIdFollow = $_POST['idUserFollow'];

// Esta consulta elimina la relación de seguimiento 
$sql = "DELETE FROM follows WHERE users_id = $userID AND userToFollowId = $userIdFollow";
$query = mysqli_query($connect, $sql);

header("Location: ../home/home.php");


?>