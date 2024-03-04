<?php

include("../config.php");
$date = date("Y/m/d");

$catchData = file_get_contents("php://input");

if(!$catchData) {
    die("No Data Found");
}

$metadata = json_decode($catchData, true);

$event_name_sql = "SELECT Event_name FROM Event_table WHERE Event_name = ".$metadata['Event'];
$event_timestamp_sql = "SELECT Event_timestamp FROM Event_table WHERE Event_name = ".$metadata['Event'];

$sql = "INSERT INTO notification_table('Event_name','Event_timestamp','notify_timestamp') 
        VALUES('(".$event_name_sql.")','(".$event_timestamp_sql.")','".$metadata['Gen_timestamp']."');";
        
//DOUBLE QUERY TO SELECT THE AUTHOR FROM EVENT WHERE EVENT_NAME = Event_name

        
