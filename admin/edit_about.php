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
    <script type="text/javascript" src='https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js'></script>
    <script src="./js/tinymce.js"></script>
</head>

<body>
    <?php include('includes/navigation.php') ?>
    <main>
        <h2>Rediger Om os</h2>
        <form method="post" action="./includes/save_page.php">
            <textarea id="page_editor"></textarea>
            <input type="submit" name="submit" value="GEM">
        </form>
    </main>
    <?php include('../../admin/includes/footer_admin.php') ?>
</body>

</html>