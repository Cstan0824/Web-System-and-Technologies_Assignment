<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer classes
require '../PhpMailSender/src/Exception.php';
require '../PhpMailSender/src/PHPMailer.php';
require '../PhpMailSender/src/SMTP.php';


function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(isset($_POST['otp'])) {
    session_start();
    date_default_timezone_set('Asia/Kuala_Lumpur');
    include('../Root/connect-db.php');

    $otp = $_POST['otp'] ;
    $otp = validate($otp);

    if($otp != $_SESSION['otp']) {
        echo "<script>alert('Invalid OTP');</script>";
        exit();
    }
    unset($_SESSION['otp']);
    $sql = "SELECT Member_name, Member_password FROM t_member WHERE Member_id = '$user_id' AND Member_email = '$email'";
    $result = $connect_db->query($sql);
    $row = $result->fetch_assoc();
    $name = $row['Member_name'];
    $password = $row['Member_password'];




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

        // Content
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        // Email sender and recipient
        $mail->setFrom('tarumtmoviesociety@gmail.com', 'TARUMT Movie Society');// sender

        // Loop through the array of event details
        foreach ($eventDetails as $event) {

            $mail->addAddress($email, $name); // recipient
            // Get from database instead of session
            $mail->Subject = "TARUMT Movie Society: Upcoming Event Notification";
            //show member heis password
            $mail->Body = "<h4>Dear  ".$name.",<br/><br/>
            Your password is: ".$password.".
            <br/> Please contact us for further information. Thank you.</h4><br/>
            Best Regards,<br/>
            <b>TARUMT Movie Society</b><br/>";

            $mail->send();
            $mail->clearAllRecipients();
        }
    } catch (Exception $e) {
        echo "<script>console.log('Email could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
    }
}
