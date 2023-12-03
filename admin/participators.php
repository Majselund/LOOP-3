<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "/../database/config.php";
    $getUser = $mysqli->query("SELECT * FROM users WHERE id = {$_SESSION["user_id"]}");
    $user = $getUser->fetch_assoc();
}

// $result = $mysqli->query("SELECT * FROM tilmeldinger");
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $uddannelsessted = $row['uddannelsessted'];
//         $antal_elever = $row['antal_elever'];
//         $kontaktperson = $row['kontaktperson'];
//         $telefonnummer = $row['telefonnummer'];
//         $emailadresse = $row['emailadresse'];
//     }
// }
?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../styles/global.css">
    <link rel="stylesheet" href="participators.css">
</head>

<body>
    <?php include('includes/navigation.php') ?>
    <?php if (isset($user)) : ?>
        <main>
            <h1>Tilmeldte</h1>
            <div class="container mx-auto flex">
                <?php
                $result = $mysqli->query("SELECT * FROM tilmeldinger");

                if ($result->num_rows > 0) {
                    echo "<table>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['uddannelsessted'] . "</td>";
                        echo "<td>" . $row['antal_elever'] . "</td>";
                        echo "<td>" . $row['kontaktperson'] . "</td>";
                        echo "<td>" . $row['telefonnummer'] . "</td>";
                        echo "<td>" . $row['emailadresse'] . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
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
    <!-- <?php include('includes/footer_admin.php') ?> -->
</body>

</html>