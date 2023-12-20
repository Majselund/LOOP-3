<?php
//Henter id fra pågældende billede 
$id = $_GET['id'];

//opretter forbindelse til databasen
$mysqli = require __DIR__ . "/../../database/config.php";
//sletter billede fra galleriet med et pågældende id.
$sql = "DELETE FROM gallery WHERE id = ?";

$stmt = $mysqli->stmt_init();
if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}
$stmt->bind_param(
    "s",
    $id,
);

if ($stmt->execute()) {
    header('Location: gallery.php');
    exit;
} else {
    die($mysqli->error . " " . $mysqli->errno);
}
