<?php
session_start();

//Tjekker om sessionsvariablen "user_id" er sat. Dette bruges til at kontrollere, om en bruger er logget ind.
//Hvis "user_id" er sat, betyder det, at en bruger er logget ind, og if kan dermed udføres.
if (isset($_SESSION["user_id"])) {
    // Henter mysqli variablen fra database config filen.
    $mysqli = require __DIR__ . "/../database/config.php";
    //vælger alt fra tabellen users hvor id = user_id
    $getUser = $mysqli->query("SELECT * FROM users WHERE id = {$_SESSION["user_id"]}");
    $user = $getUser->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Vis tilmeldte</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="https://use.typekit.net/hpo1qtj.css">
    <link rel="stylesheet" href="participators.css">
    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon" />
</head>

<body>
    <?php include('includes/navigation.php') ?>
    <!-- Hvis man er logget ind kan man se nedenstående -->
    <?php if (isset($user)) : ?>
        <main>
            <h1>Tilmeldte</h1>
            <div class="container mx-auto flex">
                <?php
                $result = $mysqli->query("SELECT * FROM tilmeldinger");

                if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<td><strong>Uddannelsessted</strong></td>";
                    echo "<td><strong>Antal Elever</strong></td>";
                    echo "<td><strong>Konktaktperson</strong></td>";
                    echo "<td><strong>Telefon</strong></td>";
                    echo "<td><strong>Email</strong></td>";
                    echo "<td><strong>Slet tilmelding</strong></td>";
                    echo "</tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['uddannelsessted'] . "</td>";
                        echo "<td>" . $row['antal_elever'] . "</td>";
                        echo "<td>" . $row['kontaktperson'] . "</td>";
                        echo "<td>" . $row['telefonnummer'] . "</td>";
                        echo "<td>" . $row['emailadresse'] . "</td>";
                        echo "<td><a class='delete' href='delete_participator.php?id=" . $row['id'] . "'><button><svg stroke='currentColor' fill='currentColor' stroke-width='0' viewBox='0 0 24 24' height='1em' width='1em' xmlns='http://www.w3.org/2000/svg'><path d='M7 4V2H17V4H22V6H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V6H2V4H7ZM6 6V20H18V6H6ZM9 9H11V17H9V9ZM13 9H15V17H13V9Z'></path></svg></button></a></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </div>
        </main>
        <!-- Hvis man ikke er logget ind kan man se nedenstående -->
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
    <!-- <?php include('includes/footer_admin.php') ?> -->
</body>

</html>