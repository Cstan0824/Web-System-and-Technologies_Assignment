<?php
//handle the file upload

if (isset($_POST['profile_picture'])) {
    $fileType = array("png","jpeg","gif","jpg");
    $target_dir = "../Image/";
    $file = $_FILES["profile_picture"]["name"];
    $fileExtension = explode(".", $file);
    $filePath = strtolower(end($fileExtension));
    $event_upl_file_name = basename($file);
    $event_upl_path = $target_dir . uniqid('', true).".".$filePath;

    if($_FILES["profile_picture"]["size"] > 1048576) {
        echo "error when uploading file. File is too large.";
    } elseif(!in_array($filePath, $fileType)) {
        echo "error when uploading file. File type not allowed.";
    } else {
        move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $event_upl_path);
    };
}