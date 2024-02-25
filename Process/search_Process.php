<?php

include("config.php");
$search = $_GET["search"];
if(!isset($search)) {
    exit("The string is null.");
}
