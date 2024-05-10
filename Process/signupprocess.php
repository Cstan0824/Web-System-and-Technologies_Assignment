<?php

// Include your database connection file
include('../Root/connect-db.php');

// Start session
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if (isset($_POST['user']) && isset($_POST['name']) && isset($_POST['pass']) && isset($_POST['email'])) {
    // Retrieve form data and validate
    $member_id = validate($_POST['user']);
    $name = validate($_POST['name']);
    $password = validate($_POST['pass']);
    $email = validate($_POST['email']);

    // Validate form data
    if (empty($member_id)) {
        $_SESSION['error'] = "Member ID is required";
        header("Location: ../View/login_signup.php");
        exit();
    } elseif (empty($name)) {
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
        //OTP verification
        //include("OPTverification.php");


        // Insert data into the database
        $regisDate = date("Y/m/d");
        $sql = "INSERT INTO t_member (Member_id, Member_name, Member_password, Member_email, Member_regisdate) VALUES ('$member_id', '$name', '$password', '$email', '$regisDate')";

        if (mysqli_query($connect_db, $sql)) {
            // Redirect to success page or display success message
            $_SESSION['success'] = "Registration successful";
            session_destroy();
            header("Location: ../View/login_signup.php");
            exit();
        } else {
            $_SESSION['error'] = "Error: " . $sql . "<br>" . mysqli_error($conn);
            session_destroy();
            header("Location: ../View/login_signup.php");
            exit();
        }
    }
} else {
    // If the form is not submitted, redirect back to the sign-up page
    session_destroy();
    header("Location: ../View/login_signup.php");
    exit();
}
