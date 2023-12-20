<?php
$id = $_GET['id'];

//opretter forbindelse til databasen
$mysqli = require __DIR__ . "/../database/config.php";
// definerer i sql query at du vil slette fra tabellen tilmeldinger hvor id = det pågældende id
$sql = "DELETE FROM tilmeldinger WHERE id = ?";

$stmt = $mysqli->stmt_init();


// Prepares the SQL statement for execution. Det er her syntax error i sql registreres
//Hvis der er fejl kommer der besked "SQL error"
if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}
$stmt->bind_param(
    "s",
    $id,
);

//Her udføres SQL queryen. Det vil sige tilmeldingen slettes.
// hvis det lykkedes bliver man sendt tilbage til participators.php
if ($stmt->execute()) {
    header('Location: participators.php');
    exit;
} else {
    die($mysqli->error . " " . $mysqli->errno);
}
