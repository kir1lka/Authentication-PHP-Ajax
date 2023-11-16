<?php

session_start();
require_once("./connect.php");

$full_name = $_POST["full_name"];
$login = $_POST["login"];
$email = $_POST["email"];
$password = $_POST["password"];
$password_confirm = $_POST["password_confirm"];

// examination empty inputs
$error_fields = [];

if ($full_name === "") $error_fields[] = "full_name";
if ($login === "") $error_fields[] = "login";
if ($email === "") $error_fields[] = "email";
if ($password === "") $error_fields[] = "password";
if ($password_confirm === "") $error_fields[] = "password_confirm";

if (!isset($_FILES["photo"]) || empty($_FILES["photo"]["name"])) {
    $error_fields[] = "photo";
}

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

// examination password
if ($password === $password_confirm) {

    //examination photo error
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK) {
        $path = "uploads/" . time() . $_FILES["photo"]["name"];
        move_uploaded_file($_FILES["photo"]["tmp_name"], "../" . $path);

        mysqli_query($connect, "INSERT INTO `users` (`full_name`, `login`, `photo`, `email`, `password`) VALUES ('$full_name', '$login', '$path', '$email' , '$password')");

        $response = [
            "status" => true,
        ];
        echo json_encode($response);
    } else {
        $response = [
            "status" => false,
            "type" => true,
            "message" => "Ошибка при загрузке файла",
            "fields" => ['photo']
        ];
        echo json_encode($response);
    }
} else {
    $response = [
        "status" => false,
        "type" => true,
        "message" => "Пароли не совпадают!",
        "fields" => ['password', 'password_confirm']
    ];
    echo json_encode($response);
}
