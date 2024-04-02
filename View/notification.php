<?php

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
<li class="nav-item dropdown"><a class="dropdown-toggle nav-link nav-link" aria-expanded="false"
        data-bs-toggle="dropdown" href="/index.html">LINES</a>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="/list.html?line=AGSPL">LRT Ampang / Sri Petaling Line</a>
        <a class="dropdown-item" href="/list.html?line=KJL">LRT Kelana Jaya Line</a>
        <a class="dropdown-item" href="/list.html?line=MRL">KL Monorail Line</a>
        <a class="dropdown-item" href="/list.html?line=KGL">MRT Kajang Line</a>
        <a class="dropdown-item" href="/list.html?line=PYL">MRT Putrajaya Line</a>
        <a class="dropdown-item" href="/list.html?line=ETS">Electric Train Service (ETS)</a>
        <a class="dropdown-item" href="/list.html?line=Komuter">KTM Komuter / Skypark Link</a>
        <a class="dropdown-item" href="/list.html?line=DMU">Diesel Multiple Unit (DMU)</a>
            <a class="dropdown-item" href="/list.html?line=Locomotive">Locomotive (KTM)</a>
                <a class="dropdown-item" href="/list.html?line=ERL">ERL (KLIA Ekspres / Transit)</a></div>
</li>