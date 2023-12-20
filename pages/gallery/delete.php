<?php
//Henter det id der er blevet sendt med ovre fra gallery.php
$id = $_GET['id'];

//opretter forbindelse til databasen
$mysqli = require __DIR__ . "/../../database/config.php";
// Definerer vores SQL Query
$sql = "DELETE FROM gallery WHERE id = ?";

// Klargør vores statement for at kunne binde vores id ind i vores sql query
$stmt = $mysqli->stmt_init();
if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}
$stmt->bind_param(
    "s",
    $id,
);

//sletter billede fra galleriet med det pågældende id.
if ($stmt->execute()) {
    header('Location: gallery.php');
    exit;
} else {
    die($mysqli->error . " " . $mysqli->errno);
}
