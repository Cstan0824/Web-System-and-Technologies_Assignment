<?php
include('../Root/connect-db.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $eventID = $_POST['delete'];

    $sql_get_bookingID = "SELECT Booking_id FROM t_booking WHERE Event_id='$eventID'";
    $result_get_bookingID = mysqli_query($connect_db, $sql_get_bookingID);

    // Loop through the result set to fetch booking IDs
    while ($row_get_bookingID = mysqli_fetch_assoc($result_get_bookingID)) {
        $bookingID = $row_get_bookingID['Booking_id'];

        // Insert cancellation record for each booking
        $sql_delete_booking = "INSERT INTO t_booking_cancellation (Booking_Cancelled_By, Booking_Cancel_Date, Booking_id) VALUES ('".$_SESSION['Staff_id']."', NOW(), '$bookingID')";
        $execute_delete_booking = mysqli_query($connect_db, $sql_delete_booking);
    }

    // Insert cancellation record for the event
    $sql_delete_event = "INSERT INTO t_event_cancellation (Event_cancelled_by, Cancel_Date, Event_id) VALUES ('".$_SESSION['Staff_id']."', NOW(), '$eventID')";
    $execute_delete_event = mysqli_query($connect_db, $sql_delete_event);

    // Redirect back to the previous page or a default page
    if(isset($_SERVER['HTTP_REFERER'])) {
        header("Location: {$_SERVER['HTTP_REFERER']}");
    } else {
        header("Location: ../View/Event.php");
    }
}

