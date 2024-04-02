<?php
$sql = "SELECT * FROM user_record;";
$result = $conn->query($sql);

;?>
<div>
    <dl>
        <?php while($row = $result->fetch_assoc()) {
            echo "
            <dt>Viewed : ".$row["Event"]."</dt>
            <dd>at ".$row["Time_stamp"]." by ".$row["Author"]."</dd>";
        }
        ?>
    </dl>
</div>
-- something like this --
<?php $conn->close();?>
