<?php

include('../Root/connect-db.php');

$user_id = $_POST['user'];
$sql_getMemberID = "SELECT Member_id FROM t_member";
$execute_getMemberID = mysqli_query($connect_db, $sql_getMemberID);
$memberIDinDB = array();
while($row_memberID = mysqli_fetch_assoc($execute_getMemberID)) {
    $memberIDinDB[] = $row_memberID['Member_id'];
}

if (in_array($user_id, $memberIDinDB)) {
    echo "Sign Up Failed. Member ID already exists";
} else {
    echo "Sign Up Successful.";
}
