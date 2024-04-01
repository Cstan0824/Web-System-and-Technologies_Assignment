<?php

$db_hostname = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "movie_society";

$connect_db = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);

if (!$connect_db) {
    die("Failed to connect to database: " . mysqli_connect_error());
}