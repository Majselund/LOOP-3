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
    <title>Create User</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../styles/global.css">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="./js/validation.js" defer></script>
</head>

<body>
    <?php include('includes/navigation.php') ?>
    <h1>Create User</h1>
    <?php if (isset($user)) : ?>
        <main>
            <div class="container mx-auto">
                <form action="process-signup.php" method="post" id="signup">
                    <div>
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" />
                    </div>
                    <div>
                        <label for="email">email</label>
                        <input type="email" id="email" name="email" />
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" />
                    </div>
                    <div>
                        <label for="password_confirmation">Repeat password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" />
                    </div>
                    <button>Sign up</button>
                </form>
            </div>
        </main>
    <?php else : ?>
        <main>
            <div class="container mx-auto">
                <p><a href="login.php">Log in</a></p>
            </div>
        </main>
    <?php endif; ?>
</body>

</html>