<?php
require_once "../connection/connection.php";
session_start();

$connect = connection();

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
}

$idUserSession = $_SESSION['usuario']["id"];
$username = '';
$text = '';

//Comprueba que se han enviado ambos valores
if (isset($_POST['message']) && isset($_POST['username'])) {
    $text = $_POST['message'];
    $username = $_POST['username'];
}

$date = date('Y-m-d');

//Query para obtener el username
$sqlUserid = "SELECT id FROM social_network.users WHERE username = '$username';";
$idUserSearch = mysqli_query($connect, $sqlUserid);

//Si el usuario busco es true y devuelve un resultado la query
if ($idUserSearch && mysqli_num_rows($idUserSearch) > 0) {
    $userDataId = mysqli_fetch_assoc($idUserSearch)['id'];

    //Inserta el mensaje en la base de datos
    $sqlMessage = "INSERT INTO social_network.private_messages (senderId, receiverId, text, createDate) VALUES ($idUserSession, $userDataId, '$text', '$date')";

    // Ejecuta la consulta e imprime cualquier error
    if (mysqli_query($connect, $sqlMessage)) {
        header("Location: ../functionalities/messages.php");
    } else {
        echo "Error: " . mysqli_error($connect);
    }
} else {
    //Se devuelve al usuario al home
    $_SESSION['add'] = 'User not found.';
    header("Location: ../home/home.php");
}

?>