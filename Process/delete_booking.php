<?php
include("../Root/connect-db.php");
session_start();
$role = $_SESSION['role'];
$user_id = $_SESSION[''.$role.'_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    
    $booking_id = $_POST['delete'];
    $sql_delete = "INSERT INTO t_booking_cancellation (Booking_Cancelled_By, Booking_Cancel_Date, Booking_id) VALUES ('".$user_id."', NOW(), '$booking_id')";

    $execute_delete = mysqli_query($connect_db, $sql_delete);
    
    if(isset($_SERVER['HTTP_REFERER'])) {
        // Redirect back to the previous page
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }else{
         // If HTTP_REFERER is not set, redirect to a default page
        header("Location: ../View/Event.php");
    }
    
}


