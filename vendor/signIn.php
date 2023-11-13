<?php

session_start();
require_once("./connect.php");

$login = $_POST["login"];
$password = $_POST["password"];

$user_find = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");

if (mysqli_num_rows($user_find)) {

    $user = mysqli_fetch_assoc($user_find);
    $_SESSION["user"] = [
        "id" => $user["id"],
        "full_name" => $user["full_name"],
        "photo" => $user["photo"],
        "email" => $user["email"],
    ];
    header('Location: ../home.php');
} else {
    $_SESSION["messageError"] = "Не верный пaроль или логин!";
    header('Location: ../index.php');
}
