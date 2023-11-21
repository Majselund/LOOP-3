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
<html>

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/global.css">
</head>

<body>
    <?php include('components/navigation.php') ?>
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
</body>

</html>