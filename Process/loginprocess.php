<?php

session_start();
include('../Root/connect-db.php');

if (isset($_POST['user']) && isset($_POST['pass'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $memberid = validate($_POST['user']);
    $password = validate($_POST['pass']);

    if (empty($memberid)) {
        $_SESSION['error'] = "Member ID is required";
        header("Location: ../View/login_signup.php");
        exit();
    } elseif (empty($password)) {
        $_SESSION['error'] = "Password is required";
        header("Location: ../View/login_signup.php");
        exit();
    } else {
        // Check in t_member table
        $sql_member = "SELECT * FROM t_member WHERE Member_id='$memberid'";
        $result_member = mysqli_query($connect_db, $sql_member);

        // Check in t_staff table
        $sql_staff = "SELECT * FROM t_staff WHERE Staff_id='$memberid'";
        $result_staff = mysqli_query($connect_db, $sql_staff);

        if (mysqli_num_rows($result_member) === 1) {
            $role = "Member";
            $row_member = mysqli_fetch_assoc($result_member);
            if ($row_member['Member_id'] === $memberid && $row_member['Member_password'] === $password) {
                $_SESSION['role'] = $role;
                $_SESSION['Member_id'] = $row_member['Member_id'];
                include("../Process/pushupcomingevent_notification.php");
                header("Location: ../View/Home.php");
                exit();
            } else {
                $_SESSION['error'] = "Incorrect username or password";
            }
        } elseif (mysqli_num_rows($result_staff) === 1) {
            $role = "Staff";
            $row_staff = mysqli_fetch_assoc($result_staff);
            if ($row_staff['Staff_id'] === $memberid && $row_staff['Staff_password'] === $password) {
                $_SESSION['role'] = $role;
                $_SESSION['Staff_id'] = $row_staff['Staff_id'];
                include("../Process/pushupcomingevent_notification.php");
                header("Location: ../View/Home.php");
                exit();
            } else {
                $_SESSION['error'] = "Incorrect username or password";
            }
        } else {
            $_SESSION['error'] = "Incorrect username or password";
        }
    }

    header("Location: ../View/login_signup.php");
    exit();

} else {
    header("Location: ../View/login_signup.php");
    exit();
}
