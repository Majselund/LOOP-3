<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/../database/config.php";
    $sql = "SELECT * FROM users WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rediger side</title>
    <link rel="stylesheet" href="../styles/global.css">
</head>

<body>
    <?php include('includes/navigation.php') ?>
    <main>
        <div class="flex">
            <p>Hjem</p><a href="./edit_home.php">Rediger</a>
        </div>
        <div class="flex">
            <p>Om os</p><a href="./edit_about.php">Rediger</a>
        </div>
        <p>Sponsorer</p>
        <p>Galleri</p>
    </main>
</body>

</html>