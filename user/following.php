<?php

require_once "../connection/connection.php";
session_start();

$connect = connection();

if (!isset($_SESSION["usuario"])) {
    header("Location: ../index.php");
}

//Obtiene el id del usuario de la session
$userID = $_SESSION['usuario']['id'];

//Obtiene el id del usuario a seguir que se envia por el metodo POST
$userIdFollow = $_POST['idUserFollow'];

//Query donde se inserta el seguimiento
$sql = "INSERT INTO follows (users_id, userToFollowId) VALUES ('$userID', '$userIdFollow')";
$query = mysqli_query($connect, $sql);

header("Location: ../home/home.php");

?>