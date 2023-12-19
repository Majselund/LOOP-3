<?php
// login til database

$dbhost = "mysql37.unoeuro.com";
$dbusername = "innovationsdage_dk";
$dbpassword = "rhmncHfe64RtDd5Bgz2A";
$dbname = "innovationsdage_dk_db";

// klargør forbindelsesstreng
$mysqli = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
