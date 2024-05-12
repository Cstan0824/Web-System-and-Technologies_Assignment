<?php

include("../Root/connect-db.php");

session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');
$dataValidated = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] === UPLOAD_ERR_OK) {
        $fileType = array("png", "jpeg", "gif", "jpg");
        $target_dir = "../Image/profile_picture/";
        $file = $_FILES["profile_picture"]["name"];
        $fileExtension = explode(".", $file);
        $fileExt = strtolower(end($fileExtension));
        $member_upl_file_name = uniqid('', true) . "." . $fileExt;
        $member_upl_path = $target_dir . $member_upl_file_name;

        if ($_FILES["profile_picture"]["size"] > 1073741824) {
            echo "Error when uploading file. File is too large.";
            $dataValidated = 0;
        } elseif (!in_array($fileExt, $fileType)) {
            echo "Error when uploading file. File type not allowed.";
            $dataValidated = 0;
        } else {
            if (!move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $member_upl_path)) {
                echo "Error when uploading file.";
                $dataValidated = 0;
            }
        }
    } else {
        echo "Error when uploading file.";
        $dataValidated = 0;
    }
}

if ($dataValidated) {
    if (!isset($_SESSION['Member_id'])) {
        echo "Error: Session Member_id not set.";
        exit;
    }

    $sql_update_profilepic = "UPDATE t_member SET Member_upl_file_name='$member_upl_file_name', Member_upl_path='$member_upl_path' WHERE Member_id='$_SESSION[Member_id]'";
    $execute_update = mysqli_query($connect_db, $sql_update_profilepic);

    if ($execute_update == 1) {
        $old_profilepic = $_SESSION['user_pic_path'];
        unlink($old_profilepic);
        $_SESSION['user_pic_path'] = $member_upl_path;
        $_SESSION['user_pic_file_name'] = $member_upl_file_name;
        header("Location: ../View/profile.php");
        exit;
    } else {
        echo "Error when updating profile picture.";
    }
}
