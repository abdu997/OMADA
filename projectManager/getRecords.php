<?php
include("../php/connect.php");
$output = array();
if (isset($_GET['goal_id'])) {
    $goal_id   = $_GET['goal_id'];
    $query  = "SELECT * FROM progress_record WHERE team_id='$team_id' and goal_id='$goal_id' ";
    $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $user_id = $row[1];
                $sql = "SELECT first_name, last_name FROM users WHERE idusers = '$user_id'";
                $res = mysqli_query($connect,$sql);
                $names = mysqli_fetch_array($res);
                $row["user"] = $names[0].' '.$names[1];
                $output[] = $row;
            }
            echo json_encode($output);
        }
}
?> 
