<?php
//handle the file upload
include("../Root/connect-db.php");

session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');
$dataValidated = 1;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] === UPLOAD_ERR_OK){
        $fileType = array("png","jpeg","gif","jpg");
        $target_dir = "../Image/profile_picture/";
        $file = $_FILES["profile_picture"]["name"];
        $fileExtension = explode(".", $file);
        $filePath = strtolower(end($fileExtension));
        $member_upl_file_name = basename($file);
        $member_upl_path = $target_dir . uniqid('', true).".".$filePath;

        if($_FILES["profile_picture"]["size"] > 104857600) {
            echo "Error when uploading file. File is too large.";
            $dataValidated = 0;
        } elseif(!in_array($filePath, $fileType)) {
            echo "Error when uploading file. File type not allowed.";
            $dataValidated = 0;
        } else {
            move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $member_upl_path);
        };
    }
}

if($dataValidated){

    $sql_update_profilepic = "UPDATE t_member SET Member_upl_file_name='$member_upl_file_name', Member_upl_path='$member_upl_path' WHERE Member_id='$_SESSION[Member_id]'";
    $execute_update = mysqli_query($connect_db, $sql_update_profilepic);

    if($execute_update){
        $_SESSION['Member_upl_file_name'] = $member_upl_file_name;
        $_SESSION['Member_upl_path'] = $member_upl_path;
        header("Location: ../View/profile.php");
    } else {
        echo "Error when updating profile picture.";
    }

}