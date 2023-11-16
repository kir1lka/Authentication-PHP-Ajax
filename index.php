<?php
session_start();
if (isset($_SESSION["user"])) {
    header('Location: ../home.php');
}
?>

<!-- html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./src/style/reset.css">
    <link rel="stylesheet" href="./src/style/style.css">

    <script src="./script/loginScript.js" defer></script>

    <title>Авторизация</title>
</head>

<body>
    <form class="form">
        <label>Логин</label>
        <input type="text" name="login" class="" placeholder="Введите свой логин">
        <label>Пароль</label>
        <input type="password" name="password" class="" placeholder="Введите свой пароль">

        <!-- submit -->
        <button id="btn-login" class="buttonOpen">Войти</button>

        <!-- under link -->
        <p class="link-login">Нет акканута? <a href="./regist.php">Зарегистрироваться</a></p>

        <!-- messageError message -->
        <p id="message" class="messageError"></p>
    </form>

</body>

</html>