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
    <link rel="stylesheet" href="/admin/page_overview.css">

</head>

<body>
    <?php include('includes/navigation.php') ?>
    <main>
        <div id="main" class="content container mx-auto">
            <h1>Rediger side</h1>
            <div id="main" class="content container mx-auto prose flex">
                <a href="./edit_home.php"><button>Hjem</button></a>
                <a href="./edit_about.php"><button>Om os</button></a>
                <a href="./edit_sponsor.php"><button>Sponsorer</button></a>
                <a href="./edit_gallery.php"><button>Galleri</button></a>
            </div>
    </main>
    <?php include('includes/footer_admin.php') ?>
</body>

</html>