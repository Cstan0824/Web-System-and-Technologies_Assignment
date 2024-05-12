<?php

session_start();
include('../Root/connect-db.php');
//get the user comment
if(isset($_POST['comment']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $comment = $connect_db->real_escape_string($_POST['comment']);
    $member_id = $_SESSION['user_id'];
    $sql = "UPDATE T_member SET Member_comment = '$comment' WHERE Member_id = '$member_id';";
    echo $sql;
    $connect_db->query($sql);
    $_SESSION['user_comment'] = $_POST['comment'];
}

header('Location: ../View/profile.php');
