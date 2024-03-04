<?php

include("../config.php");
$date = date("Y/m/d");

$sql = "SELECT * FROM notification_table;";

$result = $conn->query($sql);

?>

<dl>
    <?php 
    
while($row = $result->fetch_assoc()) {
    echo "<dt>".$row["Event_name"]."will be held in ".($date - $row["Event_timestamp"])."</dt>";
    echo "<dd>".$row["notify_timestamp"]." Day ago</dd>";
}

    
    ?>
</dl>