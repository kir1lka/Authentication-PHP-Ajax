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
    <link rel="stylesheet" href="./src/style/main.css">

    <title>Авторизация</title>
</head>

<body>
    <form action="./vendor/signIn.php" method="post" class="form">
        <label>Логин</label>
        <input type="text" name="login" placeholder="Введите свой логин">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Введите свой пароль">
        <button class="buttonOpen" type="submit">Войти</button>
        <p class="link-login">Нет акканута? <a href="./regist.php">Зарегистрироваться</a></p>

        <!-- message error -->
        <?php
        if (isset($_SESSION['messageError'])) {
            echo '<p class="messageError">' . $_SESSION['messageError'] . '</p>';
            unset($_SESSION['messageError']);
        } else if (isset($_SESSION['message'])) {
            echo '<p class="message">' . $_SESSION['message'] . '</p>';
            unset($_SESSION['message']);
        }
        ?>
    </form>
</body>

</html>