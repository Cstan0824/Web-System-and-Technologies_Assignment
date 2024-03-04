<?php

<<<<<<< Updated upstream
include("config.php");
if($_POST["RTSearch_verify"] && !empty($_POST["RealTimeSearch"])) {
    $RTSearch = $_POST["RealTimeSearch"];
    $sql = "SELECT * FROM Movie_Event_Table WHERE Event_keyword_name LIKE %$RTSearch% OR Event_name='$RTSearch'";
=======
include("../config.php");
if($_POST["RTSearch_verify"] && !empty($_POST["RealTimeSearch"])) {
    $RTSearch = strtolower($_POST["RealTimeSearch"]);
    $sql = "SELECT  LOWER(*) FROM Movie_Event_Table WHERE Event_keyword_name LIKE %$RTSearch% OR Event_name='$RTSearch'";
>>>>>>> Stashed changes
    $result = $conn->query($sql);

    while($row = $result->fetch_assoc()) {
        echo "<option value='".$row["Event_name"]."'>".$row["Event_name"]."</option>";
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!empty(trim($_POST["search"]))) {
<<<<<<< Updated upstream
        $search = $_POST["search"];
        $sql = "SELECT Event_name FROM Movie_Event_Table WHERE Event_name = $search";
=======
        $search = strtolower($_POST["search"]);
        $sql = "SELECT LOWER(*) FROM Movie_Event_Table WHERE Event_name = $search";
>>>>>>> Stashed changes
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

$conn->close();
