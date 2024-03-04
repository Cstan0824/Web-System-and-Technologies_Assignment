<?php

$hostname = "";
$username = "";
$password = "";
$database = "";
$conn = new mysqli($hostname, $username, $password, $database);
if($conn->error) {
    die("Error connection with database.");
}