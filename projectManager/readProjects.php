<?php
include("../php/connect.php");
$output = array();
$query  = "SELECT * FROM team_projects WHERE team_id='$team_id' ";
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
}
?> 