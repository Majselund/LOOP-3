<?php

$dbhost = "mysql37.unoeuro.com";
$dbusername = "innovationsdage_dk";
$dbpassword = "rhmncHfe64RtDd5Bgz2A";
$dbname = "innovationsdage_dk_db";

$mysqli = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}

return $mysqli;
