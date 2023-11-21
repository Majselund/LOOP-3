<?php

$host = "mysql37.unoeuro.com";
$username = "innovationsdage_dk";
$password = "rhmncHfe64RtDd5Bgz2A";
$dbname = "innovationsdage_dk_db";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
