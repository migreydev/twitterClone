<?php
require_once "../connection/connection.php";
session_start();

$connect = connection();

if (isset($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
}

// Preparar la consulta para evitar inyecciones SQL
$stmt = $connect->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email); // 's' indica que el parámetro es una cadena
$stmt->execute();

$res = $stmt->get_result();

if ($res && mysqli_num_rows($res) == 1) {
    $user = $res->fetch_assoc();

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
$stmt->close();
$connect->close(); 

?>
