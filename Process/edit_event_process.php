<?php

include('../Root/connect-db.php');
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');
$dataValidated = 0;
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['editEvent'])) {
        $eventID = $_POST['editEvent'];
        $eventName = $_POST['eventName'];
        $eventType = $_POST['eventType'];
        $eventDate = $_POST['eventDate'];
        $eventLocation = $_POST['location'];
        $eventHoster = $_POST['eventHoster'];
        $eventStartTime = $_POST['startTime'];
        $eventEndTime = $_POST['endTime'];
        $eventMaxUser = $_POST['maxUser'];
        $eventDescription = $_POST['eventDesc'];

        $dataValidated = 1;

        if(isset($_FILES["eventPic"]) && $_FILES["eventPic"]["error"] === UPLOAD_ERR_OK){
            
            $fileType = array("png","jpeg","gif","jpg");
            $target_dir = "../Image/";
            $file = $_FILES["eventPic"]["name"];
            $fileExtension = explode(".", $file);
            $filePath = strtolower(end($fileExtension));
            $event_upl_file_name = basename($file);
            $event_upl_path = $target_dir . uniqid('', true).".".$filePath;

            

            if($_FILES["eventPic"]["size"] > 1048576) {
                echo "error when uploading file. File is too large.";
                $dataValidated = 0;
            } elseif(!in_array($filePath, $fileType)) {
                echo "error when uploading file. File type not allowed.";
                $dataValidated = 0;
            } else {
                move_uploaded_file($_FILES["eventPic"]["tmp_name"], $event_upl_path);

            };
        }   else {
            $event_upl_file_name = $_POST['eventUplFileName'];
            $event_upl_path = $_POST['eventUplPath'];
        }
    }
}

if ($dataValidated) {
    $sql_update_event =
    "UPDATE t_event 
    SET Event_name='$eventName',
        Event_type_id='$eventType',
        Event_date='$eventDate', 
        Event_location_id='$eventLocation', 
        Event_desc='$eventDescription', 
        Start_time='$eventStartTime', 
        End_time='$eventEndTime', 
        Event_upl_file_name='$event_upl_file_name',
        Event_upl_path='$event_upl_path', 
        Max_user='$eventMaxUser' 
    WHERE Event_id='$eventID'";

    // Execute the SQL update query
    $execute_update_event = mysqli_query($connect_db, $sql_update_event);

    // Redirect to event details page
    header("Location: ../View/event_details.php?event_id=$eventID");

}
