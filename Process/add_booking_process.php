<?php

include('../Root/connect-db.php');
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

if (isset($_POST['addBooking'])) {
    $eventID = $_POST['addBooking'];
    $memberID = $_POST['member'];
    $bookingDate = $_POST['date'];
}

if (isset($_POST['member-booking'])) {
    $eventID = $_POST['member-booking'];
    $memberID = $_SESSION['Member_id'];
    $bookingDate = date('Y-m-d');
}

$sql_booking = "INSERT INTO t_booking (Member_id, Event_id, Booking_date) VALUES ('$memberID', '$eventID', '$bookingDate')";
$execute_booking = mysqli_query($connect_db, $sql_booking);
$newBookingID = mysqli_insert_id($connect_db);
$connect_db->close();
include('pushbooking_notification.php');

header("Location: ../View/event_details.php?event_id=$eventID");
