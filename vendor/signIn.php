<?php

session_start();
require_once("./connect.php");

$login = $_POST["login"];
$password = $_POST["password"];

//if empty inputs
$error_fields = [];

if ($login === "") $error_fields[] = "login";
if ($password === "") $error_fields[] = "password";

if (!empty($error_fields)) {
    $response = [
        "status" => false,
        "type" => true,
        "message" => "Заполните поля!",
        "fields" => $error_fields
    ];
    echo json_encode($response);
    die();
}

//bd query
$user_find = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");

if (mysqli_num_rows($user_find)) {
    //true
    $user = mysqli_fetch_assoc($user_find);
    $_SESSION["user"] = [
        "id" => $user["id"],
        "full_name" => $user["full_name"],
        "photo" => $user["photo"],
        "email" => $user["email"],
    ];
    $response = [
        "status" => true,
        "message" => "123"
    ];
    echo json_encode($response);
} else {
    // false
    $response = [
        "status" => false,
        "message" => "Не правильный пароль или логин!"
    ];
    echo json_encode($response);
}
