<?php


session_start();
include('../Root/connect-db.php');

$role = $_SESSION['role'];
$user_id = $_SESSION[''.$role.'_id'];

// Check in t_member table
$sql_member = "SELECT * FROM t_member WHERE Member_id='$user_id'";
$result_member = mysqli_query($connect_db, $sql_member);

// Check in t_staff table
$sql_staff = "SELECT * FROM t_staff WHERE Staff_id='$user_id'";
$result_staff = mysqli_query($connect_db, $sql_staff);


if (mysqli_num_rows($result_member) === 1) {
    $row_member = mysqli_fetch_assoc($result_member);
    $_SESSION['user_id'] = $row_member['Member_id'];
    $_SESSION['user_pass'] = $row_member['Member_password'];
    $_SESSION['user_name'] = $row_member['Member_name'];
    $_SESSION['user_email'] = $row_member['Member_email'];
    $_SESSION['user_date'] = $row_member['Member_regisdate'];
    $_SESSION['user_pic_filename']  = $row_member['Member_upl_file_name'];
    $_SESSION['user_pic_path']  = $row_member['Member_upl_path'];
    $_SESSION['user_comment'] = $row_member['Member_comment'];
};

if (mysqli_num_rows($result_staff) === 1) {
    $row_staff = mysqli_fetch_assoc($result_staff);
    $_SESSION['user_id'] = $row_staff['Staff_id'];
    $_SESSION['user_pass'] = $row_staff['Staff_password'];
    $_SESSION['user_name'] = $row_staff['Staff_name'];
    $_SESSION['user_email'] = $row_staff['Staff_email'];
    $_SESSION['user_date'] = $row_staff['Staff_joindate'];
    unset($_SESSION['user_pic_filename']);  
    unset($_SESSION['user_pic_path']);
};
