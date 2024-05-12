<?php

include('../Root/connect-db.php');
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');
$dataValidated = 0;
if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['editProfile']) && $_POST['actionType'] == "editMember" || $_POST['actionType'] == "editStaff") {
        $user_id = $_POST['editProfile'];
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_pass = $_POST['user_password'];
        $user_date = $_POST['user_regisdate'];
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_pass'] = $user_pass;
        $_SESSION['user_name'] = $user_name;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['user_date'] = $user_date;

        if ($_POST['actionType'] == "editMember") {
            $sql_update_member = "UPDATE t_member 
            SET Member_name='$user_name', Member_email='$user_email', Member_password='$user_pass', Member_regisdate='$user_date' WHERE Member_id='$user_id'";
            $execute_update = mysqli_query($connect_db, $sql_update_member);
        } else {
            $sql_update_staff = "UPDATE t_staff 
            SET Staff_name='$user_name', Staff_email='$user_email', Staff_password='$user_pass', Staff_joindate='$user_date' WHERE Staff_id='$user_id'";
            $execute_update = mysqli_query($connect_db, $sql_update_staff);
        }
      
        header("Location: ../View/profile.php");

    }
    else if (isset($_POST['editProfile']) && $_POST['actionType'] == "staffEditProfile"){
        $user_id = $_POST['editProfile'];
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $user_pass = $_POST['user_password'];
        $user_date = $_POST['user_regisdate'];
        $sql_update_member = 
        "UPDATE t_member 
        SET Member_name='$user_name', Member_email='$user_email', Member_password='$user_pass', Member_regisdate='$user_date' WHERE Member_id='$user_id'";
        $execute_update = mysqli_query($connect_db, $sql_update_member);
    
        // Redirect to profile page
        header("Location: ../View/member_profile.php?Member_id=$user_id");
    }
    
}