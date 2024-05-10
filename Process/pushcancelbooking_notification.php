<?php
//Call data from database - Booking Cancellation
include("../Root/connect-db.php");
$sql = "SELECT 
E.Event_name, 
M.Member_name, M.Member_email, 
BC.Booking_Cancel_Date 
FROM t_booking_cancellation BC 
JOIN t_booking B ON B.Booking_id = BC.Booking_id 
JOIN t_event E ON E.Event_id = B.Event_id 
JOIN t_member M ON B.Member_id = M.Member_id 
WHERE BC.Booking_id = '$booking_id';";

$eventDetails = array();
$result = $connect_db->query($sql);
if($row = $result->fetch_assoc()) {
    $eventDetails['Event_name'] = $row['Event_name'];
    $eventDetails['Member_name'] = $row['Member_name'];
    $eventDetails['Member_email'] = $row['Member_email'];
    $eventDetails['Booking_Cancel_Date'] = $row['Booking_Cancel_Date'];
}

$connect_db->close();
//PHP Mailer
//references: https://www.youtube.com/watch?v=9tD8lA9foxw
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer classes
require '../PhpMailSender/src/Exception.php';
require '../PhpMailSender/src/PHPMailer.php';
require '../PhpMailSender/src/SMTP.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tarumtmoviesociety@gmail.com'; //password: moviesociety1234
    $mail->Password = 'hqcqfvfedfuixvit'; //app name: Movie Society
    $mail->SMTPSecure = 'ssl'; //TLS or SSL secure connection
    $mail->Port = 465; //TCP port

    // Email sender and recipient
    $mail->setFrom('tarumtmoviesociety@gmail.com', 'TARUMT Movie Society');// sender
    $mail->addAddress($eventDetails['Member_email'], $eventDetails['Member_name']); // recipient
    //get from database instead of session

    //Content
    $mail->isHTML(true);

    $mail->Subject = "TARUMT Movie Society: Booking Cancelled";
    $mail->Body = "<h4>Dear  ".$eventDetails['Member_name'].",<br/><br/>
    Your Booking for <b>\"".$eventDetails['Event_name']."\"</b> has been cancelled since "
    .$eventDetails["Booking_Cancel_Date"].".
    <br/> Please contact us for further information. Thank you.</h4><br/>
    Best Regards,<br/>
    <b>TARUMT Movie Society</b><br/>";

    // Send email
    $mail->send();
} catch (Exception $e) {
    echo "<script>console.log('Email could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
}
?>
