<?php

include("../Root/connect-db.php");

// Set the JSON header
header('Content-Type: application/json');


//Search Button


if(isset($_GET['searchBarList']) && $_GET['searchBarList'] == 1) {
    //Search Bar
    $sql = "SELECT E.Event_name 
    FROM T_Event E
    LEFT JOIN T_Event_Cancellation EC ON E.Event_id = EC.Event_id
    WHERE EC.Event_id IS NULL
    ;";

    $result = $connect_db->query($sql);
    if($result->num_rows <= 0) {
        die();
    }

    $data = array();
    while($row = $result->fetch_assoc()) {
        $data[] = $row["Event_name"];
    }
    $json_response = json_encode($data);

    echo $json_response;
}


$connect_db->close();
