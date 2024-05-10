<?php

//Call data from database - Booking Cancellation
include("../Root/connect-db.php");
$sql = "SELECT * FROM T_Booking B 
JOIN T_MEMBER M ON B.Member_id = M.Member_id
JOIN T_EVENT E ON B.Event_id = E.Event_id
LEFT JOIN T_BOOKING_CANCELLATION BC ON B.Booking_id = BC.Booking_id 
WHERE BC.Booking_id IS NULL AND E.Event_date = CURDATE() + INTERVAL 1 DAY;";

$eventDetails = array();
$result = $connect_db->query($sql);
while($row = $result->fetch_assoc()) {
    $eventDetails[] = array(
        'Event_name' => $row['Event_name'],
        'Member_name' => $row['Member_name'],
        'Member_email' => $row['Member_email'],
        'Event_Date' => $row['Event_date'],
        'Booking_id' => $row['Booking_id']
    );
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

if(count($eventDetails) > 0 && !empty($eventDetails)) {
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tarumtmoviesociety@gmail.com'; //password: moviesociety1234
        $mail->Password = 'hqcqfvfedfuixvit'; //app name: Movie Society
        $mail->SMTPSecure = 'ssl'; //TLS or SSL secure connection
        $mail->Port = 465; //TCP port

        // Content
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        // Email sender and recipient
        $mail->setFrom('tarumtmoviesociety@gmail.com', 'TARUMT Movie Society');// sender

        // Loop through the array of event details
        foreach ($eventDetails as $event) {

            $mail->addAddress($event['Member_email'], $event['Member_name']); // recipient
            // Get from database instead of session
            $mail->Subject = "TARUMT Movie Society: Upcoming Event Notification";
            $mail->Body = "<h4>Dear  ".$event['Member_name'].",<br/>
        The Event: <b>".$event['Event_name']."</b> Coming Soon on Tomorrow!<br/>
        <br/> Please contact us for further information. Thank you.</h4>";

            // Send email
            $mail->send();
            $mail->clearAllRecipients();
        }
    } catch (Exception $e) {
        echo "<script>console.log('Email could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
    }

}
