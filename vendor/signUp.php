<?php

session_start();
require_once("./connect.php");

$full_name = $_POST["full_name"];
$login = $_POST["login"];
$email = $_POST["email"];
$password = $_POST["password"];
$password_confirm = $_POST["password_confirm"];

if ($password === $password_confirm) {
    $path = "uploads/" . time() . $_FILES["photo"]["name"];
    move_uploaded_file($_FILES["photo"]["tmp_name"], "../" . $path);
    if (!move_uploaded_file($_FILES["photo"]["tmp_name"], "../" . $path)) {
        header('Location: ../regist.php');
    }

    mysqli_query($connect, "INSERT INTO `users` ( `full_name`, `login`, `photo`, `email`, `password`) VALUES ( '$full_name', '$login', '$path', '$email' , '$password')");

    $_SESSION["message"] = "Регистрация прошла успешна!";
    header('Location: ../index.php');
} else {
    $_SESSION["messageError"] = "Пароли не совпадают!";
    header('Location: ../regist.php');
}
