<?php
session_start();
if (!isset($_SESSION["user"])) {
    header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./src/style/reset.css">
    <link rel="stylesheet" href="./src/style/style.css">


    <title>Главная страница</title>
</head>

<body>
    <div class="form" style="align-items: center;">
        <img src="<?php echo $_SESSION["user"]["photo"] ?>" width="200" alt="photo" />
        <h2><?php echo $_SESSION["user"]["full_name"] ?></h2>
        <h3><?php echo $_SESSION["user"]["email"] ?></h2>

            <a href="./vendor/logOut.php" style="color: #fff"><button id="btn-login" class="buttonOpen">Выход</button></a>


    </div>
</body>

</html>