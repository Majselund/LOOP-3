<?php

$uddannelsessted = $_POST["uddannelsessted"];
$kontaktperson = $_POST["kontaktperson"];
$telefonnummer = filter_input(INPUT_POST, "telefonnummer", FILTER_VALIDATE_INT);
$emailadresse = $_POST["emailadresse"];
$terms = filter_input(INPUT_POST, "terms", FILTER_VALIDATE_BOOL);
// checkbox er BOLL (TRUE) når der er kryds i boksen, ellers viser den NULL (FALSE).

if ( ! $terms) {
    die("Sæt kryds i checkbox");
}   

$host = "localhost";
$dbname = "innovationsdag";
$username = "root";
$password = "";
        
$conn = mysqli_connect(hostname: $host,
                       username: $username,
                       password: $password,
                       database: $dbname);
        
if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}           
        
$sql = "INSERT INTO tilmeldinger (uddannelsessted, kontaktperson, telefonnummer, emailadresse)
        VALUES (?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if ( ! mysqli_stmt_prepare($stmt, $sql)) {
 
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ssii",
                       $uddannelsessted,
                       $kontaktperson,
                       $telefonnummer,
                       $emailadresse);

mysqli_stmt_execute($stmt);

echo "Record saved.";

?>