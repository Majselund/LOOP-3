<?php
$id = $_GET['id'];

$mysqli = require __DIR__ . "/../../database/config.php";
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
