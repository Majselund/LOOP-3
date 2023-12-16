<?php

$uddannelsessted = $_POST["uddannelsessted"];
$antal_elever = filter_input(INPUT_POST, "antal_elever", FILTER_VALIDATE_INT);
$kontaktperson = $_POST["kontaktperson"];
$telefonnummer = filter_input(INPUT_POST, "telefonnummer", FILTER_VALIDATE_INT);
$emailadresse = $_POST["emailadresse"];
$terms = filter_input(INPUT_POST, "terms", FILTER_VALIDATE_BOOLEAN);

if (empty($uddannelsessted) || empty($kontaktperson) || empty($emailadresse) || $antal_elever === false || $telefonnummer === false) {
    die("Invalid input. Please check your form data.");
}

if (!$terms) {
    die("Sæt kryds i checkbox");
}

$mysqli = require __DIR__ . "/../../database/config.php";
$sql = "INSERT INTO tilmeldinger (uddannelsessted, antal_elever, kontaktperson, telefonnummer, emailadresse) VALUES (?, ?, ?, ?, ?)";
$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param(
    "sisis",
    $uddannelsessted,
    $antal_elever,
    $kontaktperson,
    $telefonnummer,
    $emailadresse
);

if ($stmt->execute()) {
    header("Location: ./signup_created.php");
    exit;
} else {
    die($mysqli->error . " " . $mysqli->errno);
}
