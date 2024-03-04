<?php

include("../config.php");

$catchData = file_get_contents("php://input");

if(!$catchData) {
    die("No Data Found");
}

$metadata = json_decode($catchData, true);

$sql = "INSERT INTO user_record('Author','Event','Timestamp') 
        VALUES (
            '".$metadata['Author']."',
            '".$metadata['Event']."',
            '".$metadata['Curr_timestamp']."'
        );";
//DOUBLE QUERY TO SELECT THE AUTHOR FROM EVENT WHERE EVENT_NAME = Event_name
if(!$conn->query($sql)) {
    die("Unable to fetch data to sql");
}


