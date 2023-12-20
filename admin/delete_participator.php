<?php
$id = $_GET['id'];

//opretter forbindelse til databasen
$mysqli = require __DIR__ . "/../database/config.php";
//slet fra tabellen tilmeldinger hvor id = det id det tilsvarer det pågældende tilmeldings id
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

if ($stmt->execute()) {
    header('Location: participators.php');
    exit;
} else {
    die($mysqli->error . " " . $mysqli->errno);
}
