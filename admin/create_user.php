<?php
session_start();

//Tjekker om sessionsvariablen "user_id" er sat. Dette bruges til at kontrollere, om en bruger er logget ind.
//Hvis "user_id" er sat, betyder det, at en bruger er logget ind, og if kan dermed udføres.
if (isset($_SESSION["user_id"])) {
    //opretter forbindelse til databasen
    $mysqli = require __DIR__ . "/../database/config.php";
    //Henter data fra tabellen users hvor id = bruger id
    $sql = "SELECT * FROM users WHERE id = {$_SESSION["user_id"]}";
    $result = $mysqli->query($sql);
    //henter data på den pågældende bruger
    $user = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create User</title>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="https://use.typekit.net/hpo1qtj.css">
    <link rel="stylesheet" href="./create_user.css">
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon" />
</head>

<body>
    <?php include('includes/navigation.php') ?>
    <!-- det kontrollres først at man er logget ind, og hvis man er det, kan man som admin gå ind op oprette en bruger  -->
    <?php if (isset($user)) : ?>
        <main>
            <div id="main" class="content container mx-auto">
                <h1>Opret bruger</h1>
                <div id="main" class="content container mx-auto prose">
                    <form action="./includes/process-signup.php" method="post" id="signup">
                        <div>
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" placeholder="Indsæt her" />
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="Indsæt her" />
                        </div>
                        <div>
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" placeholder="Indsæt her" />
                        </div>
                        <div>
                            <label for="password_confirmation">Repeat password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Indsæt her" />
                        </div>
                        <input type="submit" value="SUBMIT">
                    </form>
                </div>
            </div>
        </main>

        <!-- Hvis man ikke er logget ind kan man kun se siden hvor man logger ind -->
    <?php else : ?>
        <main>
            <div class="container mx-auto">
                <p><a href="login.php">Log in</a></p>
            </div>
        </main>
    <?php endif; ?>
    <?php include('includes/footer_admin.php') ?>
</body>

</html>