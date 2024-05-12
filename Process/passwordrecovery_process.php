<?php

//send the otp and compare it with the otp entered by the user
include('../Root/connect-db.php');

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//prompt user to enter the id & email and validate the email

$email = $_POST['email'];  //email
$user_id = $_POST['user_id'];   //user_id
$email = validate($email);
$user_id = validate($user_id);

//validate the data from databaase
$sql = "SELECT COUNT(*) NumOfMember FROM t_member 
WHERE Member_id = '$user_id' AND Member_email = '$email'";
$result = $connect_db->query($sql);
$row = $result->fetch_assoc();
if ($row['NumOfMember'] == 0) {
    echo "No user found with the given email and user id. Please try again.";
    exit();
}
include("generateOTP.php");
echo "success";

