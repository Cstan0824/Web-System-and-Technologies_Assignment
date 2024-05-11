<?php

//Css
$styles = "<style>
    .popup {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fefefe;
        padding: 20px;
        border: 1px solid #888;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        z-index: 9999;
    }

    .popup-content {
        text-align: center;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    body {
        background: #f2f2f2;
        font-family: 'Questrial', sans-serif;
    }

    aside.context {
        text-align: center;
        color: #333;
        line-height: 1.7;
    }

    aside.context a {
        text-decoration: none;
        color: #333;
        padding: 3px 0;
        border-bottom: 1px dashed;
    }

    aside.context a:hover {
        border-bottom: 1px solid;
    }

    aside.context .explanation {
        max-width: 700px;
        margin: 4em auto 0;
    }

    footer {
        text-align: center;
        margin: 4em auto;
        width: 100%;
    }

    footer a {
        text-decoration: none;
        display: inline-block;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: transparent;
        border: 1px dashed #333;
        color: #333;
        margin: 5px;
    }

    footer a:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    footer a .icons {
        margin-top: 12px;
        display: inline-block;
        font-size: 20px;
    }

    .main-content {
        margin: 4em auto 0;
        width: 740px;
        text-transform: uppercase;
    }

    .ticket {
        display: grid;
        grid-template-columns: auto 143px;
        background: #f3f1c9;
        border-radius: 10px;
        border: 2px solid #222;
        cursor: default;
    }

    .ticket__main {
        display: grid;
        grid-template-columns: repeat(6, 1fr) 120px;
        grid-template-rows: repeat(4, min-content) auto;
        padding: 10px;
    }

    .header {
        grid-area: title;
        grid-column: span 9;
        grid-row: 1;
        font: 900 38px 'Montserrat', sans-serif;
        padding: 5px 0 5px 20px;
        letter-spacing: 6px;
        background: #111;
        color: #f3f1c9;
    }

    .info {
        border: 3px solid;
        border-width: 0 3px 3px 0;
        padding: 8px;
    }

    .info__item {
        font: 400 13px 'Questrial', sans-serif;
        letter-spacing: 0.5px;
    }

    .info__detail {
        font: 700 20px/1 'Jura';
        letter-spacing: 1px;
        margin: 4px 0;
    }

    .passenger {
        grid-column: 1 / span 6;
    }

    .platform {
        grid-column: 7 / span 2;
        grid-row: 2 / span 3;
        background: #c02a28;
        color: #fff;
        border-color: #000;
        text-align: center;
        padding: 80px 0;
    }

    .platform span {
        display: block;
    }

    .platform span:nth-child(1) {
        font: 900 22px/1 'Montserrat';
        letter-spacing: 1.5px;
    }

    .platform span:nth-child(2) {
        font: 900 29px/1 'Montserrat';
        letter-spacing: 3px;
    }

    .platform span:nth-child(3) {
        font: 900 16px/1.2 'Montserrat';
        letter-spacing: 0.5px;
    }

    .platform .number {
        display: flex;
        margin-top: 12px;
        position: relative;
    }

    .platform .number div:nth-child(1) {
        position: absolute;
        left: 16px;
        font: 900 90px/1 'Old Standard TT';
    }

    .platform .number span {
        font: 900 36px/1 'Old Standard TT';
        position: absolute;
        right: 18px;
    }

    .platform .number span:nth-child(1) {
        top: -2px;
        border-bottom: 2px solid;
        padding: 0 2px;
    }

    .platform .number span:nth-child(2) {
        top: 44px;
    }

    .arrival {
        grid-column-start: span 4;
    }

    .departure {
        grid-column-start: span 2;
    }

    .passenger,
    .departure,
    .date {
        border-left: 3px solid;
    }

    .date,
    .time {
        grid-column-start: span 2;
    }

    .fineprint {
        grid-column-start: span 5;
        font-size: 14px;
        font-family: 'Inconsolata';
        line-height: 1;
        margin-top: 10px;
        padding-right: 5px;
    }

    .fineprint p:nth-child(2) {
        margin: 4px 4px 0 0;
        padding-top: 4px;
        border-top: 1.5px dotted;
        font: 11px/1 'Inconsolata';
    }

    .snack {
        grid-column: 6 / span 1;
        width: 65px;
        margin: 10px 10px 0 0;
        position: relative;
        background: #000;
        padding: 6px 0 2px;
        text-align: center;
        border-radius: 5px;
    }

    .snack svg {
        fill: #f3f1c9;
        width: 36px;
    }

    .snack__name {
        color: #f3f1c9;
        font-size: 12px;
    }

    .barcode {
        grid-column-start: span 1;
        display: grid;
        margin: 10px 0 0;
        grid-template-rows: 1fr min-content;
    }

    .barcode__scan {
        background: linear-gradient(to right, #333 2%, #333 4%, transparent 4%, transparent 5%, #333 5%, #333 6%, transparent 6%, #333 6%, #333 8%, transparent 8%, transparent 9%, #333 9%, #333 10.5%, transparent 10.5%, transparent 11%, #333 11%, #333 12%, transparent 12%, transparent 13.5%, #333 13.5%, #333 15%, #333 17%, transparent 17%, transparent 19%, #333 19%, #333 20%, transparent 20%, transparent 21%, #333 21%, #333 22%, transparent 22%, transparent 23.5%, #333 23.5%, #333 25%, transparent 25%, transparent 26.5%, #333 26.5%, #333 27.5%, transparent 27.5%, transparent 28.5%, #333 28.5%, #333 30%, transparent 30%, transparent 32%, #333 32%, #333 34%, #333 36%, transparent 36%, transparent 37.5%, #333 37.5%, #333 40%, transparent 40%, transparent 41.5%, #333 41.5%, #333 43%, transparent 43%, transparent 46%, #333 46%, #333 48%, transparent 48%, transparent 49%, #333 49%, transparent 49%, transparent 50%, #333 50%, #333 51%, transparent 51%, transparent 53%, #333 53%, #333 54.5%, transparent 54.5%, transparent 56%, #333 56%, #333 58%, transparent 58%, transparent 59%, #333 59%, #333 60%, #333 62.5%, transparent 62.5%, transparent 64%, #333 64%, #333 64%, #333 67%, transparent 67%, transparent 69%, #333 69%, #333 70%, transparent 70%, transparent 71%, #333 71%, #333 72%, transparent 72%, transparent 73.5%, #333 73.5%, #333 76%, transparent 76%, transparent 79%, #333 79%, #333 80%, transparent 80%, transparent 82%, #333 82%, #333 82.5%, transparent 82.5%, transparent 84%, #333 84%, #333 87%, transparent 87%, transparent 89%, #333 89%, #333 91%, transparent 91%, transparent 92%, #333 92%, #333 95%, transparent 95%);
    }

    .barcode__id {
        letter-spacing: 4px;
        padding: 2px 0 0;
        color: #c02a28;
        font: 700 16px/1 'Jura';
    }

    .ticket__side {
        background: rgba(192, 42, 40, 0.2);
        box-sizing: border-box;
        border-left: 1.5px dashed #111;
        display: grid;
        grid-template-rows: repeat(2, 124px) 60px;
        grid-template-columns: 40px repeat(2, 45px);
        border-radius: 0 10px 10px 0;
    }

    .ticket__side .logo {
        text-align: center;
        background: #c02a28;
        padding: 10px 5px 10px 0px;
        margin: 10px 0 0 0px;
        font: 900 16px/1 'Montserrat';
        letter-spacing: 1.5px;
        grid-column: 1 / span 1;
        grid-row: 1 / span 2;
        position: relative;
        color: #fff;
        writing-mode: vertical-rl;
    }

    .ticket__side .logo p {
        transform: rotate(180deg);
    }

    .ticket__side .info {
        border: 3px solid #c02a28;
        border-width: 3px 3px 0;
        grid-column-start: 2;
        writing-mode: vertical-rl;
        transform: rotate(180deg);
    }

    .ticket__side .info.side-arrive {
        margin-top: 10px;
        border-width: 3px;
    }

    .ticket__side .info.side-date {
        grid-column-start: 3;
        border-right: none;
    }

    .ticket__side .info.side-time {
        grid-column: 3 / span 1;
        grid-row: 1;
        margin-top: 10px;
        border-width: 3px 0 3px 3px;
    }

    .ticket__side .info__item {
        font-size: 11px;
        color: #c02a28;
    }

    .ticket__side .info__detail {
        font-size: 12px;
        margin: 0 2px 0 0;
        letter-spacing: 0px;
    }

    .ticket__side .barcode {
        grid-template-rows: 30px min-content;
        grid-row-start: 3;
        grid-column: 1 / span 3;
        margin: 9px 0 0 10px;
        text-align: center;
    }
</style>";

//Call data from database - Booking Cancellation
include("../Root/connect-db.php");
$sql = "SELECT *
FROM T_Booking B 
JOIN T_MEMBER M ON B.Member_id = M.Member_id
JOIN T_EVENT E ON B.Event_id = E.Event_id
JOIN T_EVENT_TYPE ET ON E.Event_Type_id = ET.Event_Type_id
JOIN T_EVENT_LOCATION EL ON E.Event_Location_id = EL.Event_Location_id
WHERE B.Booking_id = '$newBookingID';";

$eventDetails = array();
$result = $connect_db->query($sql);
if($row = $result->fetch_assoc()) {
    $eventDetails['Event_name'] = $row['Event_name'];
    $eventDetails['Member_id'] = $row['Member_id'];
    $eventDetails['Member_name'] = $row['Member_name'];
    $eventDetails['Member_email'] = $row['Member_email'];
    $eventDetails['Event_date'] = $row['Event_date'];
    $eventDetails['Event_type'] = $row['Event_type'];
    $eventDetails['Event_location'] = $row['Location'];
    $eventDetails['Event_address'] = $row['Address'];
    $eventDetails['Start_time'] = $row['Start_time'];
    $eventDetails['Event_hoster'] = $row['Event_hoster'];
    $eventDetails['Booking_date'] = $row['Booking_date'];
}
$connect_db->close();

//PHP Mailer Html to Pdf Converter
//references: https://www.youtube.com/watch?v=9tD8lA9foxw
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;

// Load PHPMailer classes
require '../PhpMailSender/src/Exception.php';
require '../PhpMailSender/src/PHPMailer.php';
require '../PhpMailSender/src/SMTP.php';

require_once '../dompdf/autoload.inc.php';


$ticketContent = "
<div id='ticketPopup' class='popup'>
    <div class='popup-content'>
        <div class='main-content'>
            <div class='ticket'>
                <div class='ticket__main'>
                    <div class='header'>Activities Details</div>
                    <div class='info passenger'>
                        <div class='info__item'>Member Name</div>
                        <div class='info__detail'>".$eventDetails['Member_name']."</div>
                    </div>
                    <div class='info platform'> <span>Please </span><span>arrive </span><span>early</span>
                    </div>
                    <div class='info departure'>
                        <div class='info__item'>Categories</div>
                        <div class='info__detail'>".$eventDetails['Event_type']."</div>
                    </div>
                    <div class='info arrival'>
                        <div class='info__item'>Movie Name</div>
                        <div class='info__detail'>".$eventDetails['Event_name']."</div>
                    </div>
                    <div class='info date'>
                        <div class='info__item'>Date</div>
                        <div class='info__detail'>".$eventDetails['Event_date']."</div>
                    </div>
                    <div class='info time'>
                        <div class='info__item'>Time</div>
                        <div class='info__detail'>".$eventDetails['Start_time']."</div>
                    </div>
                    <div class='info carriage'>
                        <div class='info__item'>Location</div>
                        <div class='info__detail'>".$eventDetails['Event_location']."</div>
                    </div>
                    <div class='info seat'>
                        <div class='info__item'>host</div>
                        <div class='info__detail'>".$eventDetails['Event_hoster']."</div>
                    </div>
                    <div class='fineprint'>
                        <p>Location : ".$eventDetails['Event_address']." </p>
                        <p>This ticket is Non-refundable • TARUMT Movie Society Authority</p>
                    </div>
                    <div class='snack'><svg viewBox='0 -11 414.00053 414'>
                            <path
                                d='m202.480469 352.128906c0-21.796875-17.671875-39.46875-39.46875-39.46875-21.800781 0-39.472657 17.667969-39.472657 39.46875 0 21.800782 17.671876 39.472656 39.472657 39.472656 21.785156-.023437 39.445312-17.683593 39.46875-39.472656zm0 0'>
                            </path>
                            <path
                                d='m348.445312 348.242188c2.148438 21.691406-13.695312 41.019531-35.390624 43.167968-21.691407 2.148438-41.015626-13.699218-43.164063-35.390625-2.148437-21.691406 13.695313-41.019531 35.386719-43.167969 21.691406-2.148437 41.019531 13.699219 43.167968 35.390626zm0 0'>
                            </path>
                            <path
                                d='m412.699219 63.554688c-1.3125-1.84375-3.433594-2.941407-5.699219-2.941407h-311.386719l-3.914062-24.742187c-3.191407-20.703125-21.050781-35.9531252-42-35.871094h-42.699219c-3.867188 0-7 3.132812-7 7s3.132812 7 7 7h42.699219c14.050781-.054688 26.03125 10.175781 28.171875 24.0625l33.800781 213.515625c3.191406 20.703125 21.050781 35.957031 42 35.871094h208.929687c3.863282 0 7-3.132813 7-7 0-3.863281-3.136718-7-7-7h-208.929687c-14.050781.054687-26.03125-10.175781-28.171875-24.0625l-5.746094-36.300781h213.980469c18.117187-.007813 34.242187-11.484376 40.179687-28.597657l39.699219-114.578125c.742188-2.140625.402344-4.511718-.914062-6.355468zm0 0'>
                            </path>
                        </svg></div>
                    <div class='barcode'>
                        <div class='barcode__scan'></div>
                        <div class='barcode__id'>001256733</div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
        ";



$mail = new PHPMailer(true);
$dompdf = new Dompdf();




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

    //Content
    $mail->isHTML(true);

    $html = $styles.$ticketContent;

    //Convert HTML to PDF
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $pdf = $dompdf->output();
    file_put_contents('../Image/ticket_pdf/'.$eventDetails['Member_id'].'-booking-'.$eventDetails['Event_name'].'-'.$eventDetails['Booking_date'].'.pdf', $pdf);
    $mail->addAttachment('../Image/ticket_pdf/'.$eventDetails['Member_id'].'-booking-'.$eventDetails['Event_name'].'-'.$eventDetails['Booking_date'].'.pdf');

    $mail->Subject = "TARUMT Movie Society: Booking Confirmed";
    $mail->Body = "<h4>Dear ".$eventDetails['Member_name'].",<br />
    Your Booking <b>\"".$eventDetails['Event_name']."\"</b> has been confirmed since of "
        .$eventDetails["Event_date"]."
    <br /> Please contact us for further information. Thank you.
    </h4>";

    // Send email
    $mail->send();

    echo "<script>
    console.log('Email send successfully!');
</script>";

} catch (Exception $e) {
    echo "<script>
    console.log('Email could not be sent. Mailer Error: {$mail->ErrorInfo}');
</script>";
}
