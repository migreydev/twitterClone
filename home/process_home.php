<?php
require_once "../connection/connection.php";
session_start();

$connect = connection();

if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php");
}

if(isset($_POST)){
    $tweet = $_POST['tweet'];
    $idUser = $_SESSION['usuario']["id"];
}

$idPublicacion = 0;
$date = date('Y-m-d');

$sql = "INSERT INTO publications (id, userId, text, createDate) VALUES ('$idPublicacion', '$idUser', '$tweet', '$date')";
$registro = mysqli_query($connect, $sql);
$_SESSION['add'] = 'The tweet have been added ';


?>
