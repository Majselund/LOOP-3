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

$host = "mysql37.unoeuro.com";
$dbname = "innovationsdage_dk_db";
$username = "innovationsdage_dk";
$password = "rhmncHfe64RtDd5Bgz2A";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}

$sql = "INSERT INTO tilmeldinger (uddannelsessted, antal_elever, kontaktperson, telefonnummer, emailadresse) VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    die("Error: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "sisis", $uddannelsessted, $antal_elever, $kontaktperson, $telefonnummer, $emailadresse);

mysqli_stmt_execute($stmt);

echo "Record saved.";

?>
