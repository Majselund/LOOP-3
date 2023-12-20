<?php

//Der hentes data fra tilmeldingsblanketten som gemmes i variablerne.
//Ved antal elever og telefonnummer valideres data, da det er et tal og nummer der skal indtastes. Ellers viser det fejl
// Ved Terms skal man sætte kryds i checkboksen
$uddannelsessted = $_POST["uddannelsessted"];
$antal_elever = filter_input(INPUT_POST, "antal_elever", FILTER_VALIDATE_INT);
$kontaktperson = $_POST["kontaktperson"];
$telefonnummer = filter_input(INPUT_POST, "telefonnummer", FILTER_VALIDATE_INT);
$emailadresse = $_POST["emailadresse"];
$terms = filter_input(INPUT_POST, "terms", FILTER_VALIDATE_BOOLEAN);

//hvis en af tilmeldingsfelterne er tomme kommer der beskeden "invalid inpuit. Please check yor form data"
if (empty($uddannelsessted) || empty($kontaktperson) || empty($emailadresse) || $antal_elever === false || $telefonnummer === false) {
    die("Invalid input. Please check your form data.");
}

//Hvis man ikke har sat kryds i boksen kommer der beskeden "sæt kryds i checkboks"
if (!$terms) {
    die("Sæt kryds i checkbox");
}

//Opretter forbindelse til databasen
$mysqli = require __DIR__ . "/../../database/config.php";
//Sender indtastede values i tilmeldingsblanketten til databasen.
$sql = "INSERT INTO tilmeldinger (uddannelsessted, antal_elever, kontaktperson, telefonnummer, emailadresse) VALUES (?, ?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();

// Prepare SQL statement for execution. Det er her syntax error i SQL registreres
//Hvis der er fejl kommer der besked "SQL error"
if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

//Speciferer de forskellige typer variabler. String eller int.
$stmt->bind_param(
    "sisis",
    $uddannelsessted,
    $antal_elever,
    $kontaktperson,
    $telefonnummer,
    $emailadresse
);

// hvis registrering er vellykket dirigeres man til "signup_created.php"
if ($stmt->execute()) {
    header("Location: ./signup_created.php");
    exit;
} else {
    die($mysqli->error . " " . $mysqli->errno);
}
