<?php

include("../Root/connect-db.php");

echo "Hello";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty(trim($_POST["search"]))) {

        $search = $_POST["search"];
        $sql = "SELECT Event_name FROM T_Event WHERE Event_name LIKE %$RTSearch%;";

        $result = $conn->query($sql);
        if($result->num_rows <= 0) {
            die("Row Not found");
        }
        echo "<thead>
                <tr>
                    <th>Event name</th>
                    <th>Event Location</th>
                </tr>
            </thead>";

        echo "<tbody>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row['Event_name']."</td>
                    <td>".$row['Event_location']."</td>".
                "</tr>";
        }
        echo "</tbody>";
    }
}


if($_POST["RTSearch_verify"] && !empty($_POST["RealTimeSearch"])) {
    $RTSearch = $_POST["RealTimeSearch"];
    $sql = "SELECT Event_name FROM T_Event WHERE LOWER(Event_name) LIKE %$RTSearch%;";

    $result = $conn->query($sql);
    if($result->num_rows <= 0) {
        die("Row Not found");
    }

    while($row = $result->fetch_assoc()) {
        echo "<option value='".$row["Event_name"]."'>".$row["Event_name"]."</option>";
    }
}

$conn->close();
