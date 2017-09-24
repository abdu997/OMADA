<?php
include("../php/connect.php");
$output = array();
if (isset($_GET['project_id'])) {
    $project_id   = $_GET['project_id'];
    $query  = "SELECT * FROM team_goal WHERE team_id='$team_id' and project_id='$project_id' ";
    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output[] = $row;
        }
        echo json_encode($output);
}}
?> 