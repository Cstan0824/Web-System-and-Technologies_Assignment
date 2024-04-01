<?php
session_start();
include('../Root/connect-db.php');

if (isset($_POST['user']) && isset($_POST['pass'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $memberid = validate($_POST['user']);
    $password = validate($_POST['pass']);

    if (empty($memberid)) {
        $_SESSION['error'] = "Member ID is required";
    } elseif (empty($password)) {
        $_SESSION['error'] = "Password is required";
    } else {
        $sql = "SELECT * FROM t_member WHERE Member_id='$memberid'";
        $result = mysqli_query($connect_db, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['Member_id'] === $memberid && $row['Member_password'] === $password) {
                $_SESSION['Member_id'] = $row['Member_id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                header("Location: ../View/Home.php");
                exit();
            } else {
                $_SESSION['error'] = "Incorrect username or password";
            }
        } else {
            $_SESSION['error'] = "Incorrect username or password";
        }
    }

    header("Location: ../View/login.php");
    exit();

} else {
    header("Location: ../View/login.php");
    exit();
}
