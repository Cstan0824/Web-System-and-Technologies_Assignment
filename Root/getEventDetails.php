<?php

include("../Root/connect-db.php");
$eventID = $_GET['event_id'];

$sql_event = "SELECT * FROM t_event WHERE Event_id='$eventID'";
$result_event = mysqli_query($connect_db, $sql_event);

$sql_event_type = "SELECT * FROM t_event_type";
$result_event_type = mysqli_query($connect_db, $sql_event_type);
if (mysqli_num_rows($result_event_type) > 0) {
    $event_type_ID = array("");
    $event_type_db = array("");
    for($i = 1; $row_event_type = mysqli_fetch_assoc($result_event_type); $i++) {
        $event_type_ID[$i] = $row_event_type['Event_type_id'];
        $event_type_db[$i] = $row_event_type['Event_type'];
    }

}

$sql_event_location = "SELECT * FROM t_event_location";
$result_event_location = mysqli_query($connect_db, $sql_event_location);
if (mysqli_num_rows($result_event_location) > 0) {
    $event_location_ID = array("");
    $address = array("");
    $OI = array("");
    for($i = 1; $row_event_location = mysqli_fetch_assoc($result_event_location); $i++) {
        $event_location_ID[$i] = $row_event_location['Event_location_id'];
        $address_db[$i] = $row_event_location['Address'];
        $OI[$i] = $row_event_location['Location'];
    }

}

$sql_availability = "SELECT COUNT(*) AS num_bookings 
	FROM t_booking B
	LEFT JOIN t_booking_cancellation BC ON BC.Booking_id = B.Booking_id
	WHERE Event_id='$eventID' AND BC.Booking_id IS NULL;";
$execute_availability = mysqli_query($connect_db, $sql_availability);
$row_availability = mysqli_fetch_assoc($execute_availability);

//check if user has already booked this event
$isBooked = false;
$sql_check_booking = "SELECT * FROM t_booking WHERE Event_id='$eventID' AND Member_id='".$_SESSION['user_id']."';";
$execute_check_booking = mysqli_query($connect_db, $sql_check_booking);
if (mysqli_num_rows($execute_check_booking) > 0) {
    $isBooked = true;
}

if (mysqli_num_rows($result_event) === 1) {
    $row_event = mysqli_fetch_assoc($result_event);
    $event_name = $row_event['Event_name'];
    for ($i = 1; $i < count($event_type_ID); $i++) {
        if ($row_event['Event_type_id'] == $event_type_ID[$i]) {
            $event_type = $event_type_db[$i];
        }
    }
    for ($i = 1; $i < count($event_location_ID); $i++) {
        if ($row_event['Event_location_id'] == $event_location_ID[$i]) {
            $event_location_ID_cmp = $event_location_ID[$i];
            $location = $address_db[$i]." (".$OI[$i].") ";
        }
    }
    $event_date = $row_event['Event_date'];
    $start_time = $row_event['Start_time'];
    $end_time = $row_event['End_time'];
    $movie_details = $row_event['Event_desc'];
    $event_upl_path = $row_event['Event_upl_path'];
    $leftover = $row_event['Max_User'] - $row_availability['num_bookings'];
    $event_availability = ($leftover < 0 ? "0" : $leftover) . " / " . $row_event['Max_User'];
    $max_user = $row_event['Max_User'];
    $event_hoster = $row_event['Event_hoster'];
    $event_upl_file_name = $row_event['Event_upl_file_name'];
    $event_upl_path = $row_event['Event_upl_path'];
    $event_desc = $row_event['Event_desc'];
}
