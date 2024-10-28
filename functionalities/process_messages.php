<?php
require_once "../connection/connection.php";
session_start();

$connect = connection();

if(!isset($_SESSION['usuario'])){
    header("Location: ../index.php");
}

$idUserSession = $_SESSION['usuario']["id"];

$text = '';
$receiverId=0;

if(isset($_POST)){
    $text = $_POST['message'];
    $username = $_POST['username'];
}

$id= 0;
$date = date('Y-m-d');

$sqlUserid = "SELECT id FROM social_network.users WHERE username = '$username'";
$idUserSearch = mysqli_query($connect, $sqlUserid);


if ($idUserSearch && mysqli_num_rows($idUserSearch) > 0) {
    $userDataId = mysqli_fetch_assoc($idUserSearch)['id'];

    $sqlMessage = "INSERT INTO social_network.private_messages (id, senderId, receiverId, text, createDate) VALUES ($id, $idUserSession , $userDataId, $text, $date)";
    header("Location: ../functionalities/messages.php");

}else {
    $_SESSION['add'] = 'User not found.';
    header("Location: ../home/home.php");
}

header("Location: ../../functionalities/messages.php");

?>