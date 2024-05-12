<?php

// Include your database connection file
include('../Root/connect-db.php');
echo "<script>console.log('Connected to database');</script>";
// Start session
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

$sql_getMemberID = "SELECT * FROM t_member";
$execute_getMemberID = mysqli_query($connect_db, $sql_getMemberID);
$memberIDinDB = array("");
for ($i = 1; $row_memberID = mysqli_fetch_assoc($execute_getMemberID); $i++) {
    $memberIDinDB[$i] = $row_memberID['Member_id'];
}

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if (isset($_POST['user']) && isset($_POST['name']) && isset($_POST['pass']) && isset($_POST['email']) && isset($_POST['otp'])) {
    // Retrieve form data and validate
    $member_id = validate($_POST['user']);
    $name = validate($_POST['name']);
    $password = validate($_POST['pass']);
    $email = validate($_POST['email']);
    $otp = validate($_POST['otp']);
    echo "<script>console.log('OTP: $otp');</script>";
    // Validate form data
    if (empty($member_id)) {
        $_SESSION['error'] = "Member ID is required";
        header("Location: ../View/login_signup.php");
        exit();
    }else {
        for ($i = 1; $i < count($memberIDinDB); $i++) {
            if ($member_id == $memberIDinDB[$i]) {
                $_SESSION['error'] = "Member ID already exists";
                header("Location: ../View/login_signup.php");
                exit();
            }
        }
    }
    if (empty($name)) {
        $_SESSION['error'] = "Name is required";
        header("Location: ../View/login_signup.php");
        exit();
    } elseif (empty($password)) {
        $_SESSION['error'] = "Password is required";
        header("Location: ../View/login_signup.php");
        exit();
    } elseif (empty($email)) {
        $_SESSION['error'] = "Email is required";
        header("Location: ../View/login_signup.php");
        exit();
    } else {
        // Check if the OTP is correct
        if ($otp != $_SESSION['otp']) {
            $_SESSION['error'] = "Invalid OTP";

            session_destroy();
            echo "<script>alert('Invalid OTP');</script>";
            echo "<script>window.location.href='../View/login_signup.php';</script>";

        } else {
            unset($_SESSION['otp']);
            // Insert data into the database
            $regisDate = date("Y/m/d");
            $sql = "INSERT INTO t_member (Member_id, Member_name, Member_password, Member_email, Member_regisdate) 
            VALUES ('$member_id', '$name', '$password', '$email', '$regisDate')";

            if (mysqli_query($connect_db, $sql)) {
                // Redirect to success page or display success message
                $_SESSION['success'] = "Registration successful";

                session_destroy();
                echo "<script>alert('Registration successful');</script>";
                echo "<script>window.location.href='../View/login_signup.php';</script>";
                include("../Process/pushbooking_notification.php");
            } else {
                $_SESSION['error'] = "Error: " . $sql . "<br>" . mysqli_error($conn);
                session_destroy();
                echo "<script>alert('Error: " . $sql . "<br>" . mysqli_error($conn) . "');</script>";
                echo "<script>window.location.href='../View/login_signup.php';</script>";
            }
        }
    }
} else {
    session_destroy();

    //echo "<script>window.location.href='../View/login_signup.php';</script>";
}
