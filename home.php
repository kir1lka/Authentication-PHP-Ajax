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
    <title>Главная страница</title>
</head>

<body>
    <div>
        <img src="<?php echo $_SESSION["user"]["photo"] ?>" width="100" alt="photo" />
        <h2><?php echo $_SESSION["user"]["full_name"] ?></h2>
        <h3><?php echo $_SESSION["user"]["email"] ?></h2>
            <a href="./vendor/logOut.php">Выход</a>
    </div>
</body>

</html>