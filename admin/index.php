<?php
session_start();
//Tjekker om sessionsvariablen "user_id" er sat. Dette bruges til at kontrollere, om en bruger er logget ind.
//Hvis "user_id" er sat, betyder det, at en bruger er logget ind, og if kan dermed udføres.
if (isset($_SESSION["user_id"])) {
    //opretter forbindelse til databasen
    $mysqli = require __DIR__ . "/../database/config.php";
    //Henter alt data fra tabellen users hvor id = bruger id
    $getUser = $mysqli->query("SELECT * FROM users WHERE id = {$_SESSION["user_id"]}");
    //henter data på den pågældende bruger
    $user = $getUser->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Hjem</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="https://use.typekit.net/hpo1qtj.css">
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon" />
</head>

<body>
    <?php include('includes/navigation.php') ?>
    <!-- Man tjekker at user variabel er sat. Hvis man er logget ind kan man se nedenstående i main -->
    <?php if (isset($user)) : ?>
        <main>
            <h1>Hjem</h1>
            <div class="container mx-auto flex">
                <p>
                    <!-- en hilsen til den bruger der er logget ind så det er f.eks "Hello Eva" -->
                    Hello <?= htmlspecialchars($user["name"]) ?>
                </p>
            </div>
        </main>
        <!-- Hvis man ikke er logget ind ser man index siden hvor der står "du er ikke logget ind" -->
    <?php else : ?>
        <main>
            <h1>Hjem</h1>
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