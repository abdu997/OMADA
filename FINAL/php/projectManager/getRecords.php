<?php
include("../connect.php");
session_start();
$user_id = $_SESSION['user_id'];
$team_id = $_SESSION['team_id'];
$output = array();
if (isset($_GET['goal_id'])) {
    $goal_id   = $_GET['goal_id'];
    $query  = "SELECT * FROM progress_record WHERE team_id='$team_id' and goal_id='$goal_id' ";
    $result = mysqli_query($connect, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $user_id = $row[1];
                $sql = "SELECT first_name, last_name FROM users WHERE user_id = '$user_id'";
                $res = mysqli_query($connect,$sql);
                $names = mysqli_fetch_array($res);
                $row["user"] = $names[0].' '.$names[1];
                $output[] = $row;
            }
            echo json_encode($output);
        }
}
?>
