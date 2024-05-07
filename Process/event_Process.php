<?php

include("../Root/connect-db.php");

// Set the JSON header
header('Content-Type: application/json');

//Search Button
if($_SERVER["REQUEST_METHOD"] == "POST") {
}

// Real Time Search Bar
if($searchBarList = $_POST["searchBarList"]) {
    if($searchBarList !== 1) {
        die();
    }

    $sql = "SELECT Event_name FROM T_Event;";

    $result = $conn->query($sql);
    if($result->num_rows <= 0) {
        die("Row Not found");
    }

    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row["Event_name"];
    }
    $json_response = json_encode($data);
    echo $json_response;
}


$conn->close();
