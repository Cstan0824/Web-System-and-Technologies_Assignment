<?php

include("config.php");

$search = $_GET["search"];
if(!isset($search)) {
    exit("The search is null.");
}
$sql = "";
$conn->close();
