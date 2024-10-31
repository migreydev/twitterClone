<?php

require_once "../connection/connection.php";
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php");
}

$connect = connection();

//Se obtiene todos los datos del usuario actual de la sesion
$id = $_SESSION['usuario']['id'];
$username = $_SESSION['usuario']['username'];
$email = $_SESSION['usuario']['email'];
$password = $_SESSION['usuario']['password'];
$description = $_POST['description'];
$date =  $_SESSION['usuario']['createDate'];

//Se actualiza el usuario
$sql = "UPDATE users SET username = '$username', email = '$email', password = '$password', description = '$description', createDate = '$date' WHERE id = '$id'";
$query = mysqli_query($connect, $sql);

//Devuelve todos los campos del usuario filtrado por su id
$sqlUser = "SELECT * FROM users WHERE id = '$id'";
$queryUser = mysqli_query($connect, $sqlUser);
$userUpdate = mysqli_fetch_array($queryUser);

$_SESSION['usuario']['description'] = $userUpdate['description'];

header("Location: ../home/home.php");

?>