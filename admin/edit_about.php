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
    <link rel="stylesheet" href="./edit_about.css">
    <script type="text/javascript" src='https://cdn.tiny.cloud/1/i2q56l2uu4wsqfm78zlcivot3qxhn06jbgpapqk5b0h1o3vd/tinymce/6/tinymce.min.js'></script>
    <script src="./js/tinymce.js"></script>
</head>

<body>
    <?php include('includes/navigation.php') ?>
    <main>
        <div id="main" class="content container mx-auto">
            <h1>Rediger Om os</h1>
            <div id="main" class="content container mx-auto prose">
                <form method="post" action="./includes/save_page.php" <label for="sponsor">Skift overskirft</label><br>
                    <input type="text" name="sponsor" placeholder="Indsæt her">
                    <textarea id="page_editor"></textarea>
                    <label for="image1">Image</label>
                    <input type="file" name="images[]" id="image1" class="form-control">
                    <input type="submit" name="submit" value="GEM">
                </form>
            </div>
        </div>
    </main>
    <?php include('includes/footer_admin.php') ?>
</body>

</html>