<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/../database/config.php";
    $getUser = $mysqli->query("SELECT * FROM users WHERE id = {$_SESSION["user_id"]}");
    $user = $getUser->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="https://use.typekit.net/hpo1qtj.css">
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon" />
</head>

<body>
    <?php include('includes/navigation.php') ?>
    <?php if (isset($user)) : ?>
        <main>
            <h1>Home</h1>
            <div class="container mx-auto flex">
                <p>
                    Hello <?= htmlspecialchars($user["name"]) ?>
                </p>
            </div>
        </main>
    <?php else : ?>
        <main>
            <h1>Home</h1>
            <div class="container mx-auto flex">
                <p>
                    Du er ikke logget ind.
                </p>
            </div>
        </main>
    <?php endif; ?>
    <?php include('includes/footer_admin.php') ?>
</body>

</html>