<?php
include("../connect.php");
session_start();
$user_id = $_SESSION['user_id'];
$team_id = $_SESSION['team_id'];
$output = array();
if (isset($_GET['board_id'])) {
    $board_id = $_GET['board_id'];
    $query  = "SELECT * FROM team_goal WHERE team_id='$team_id' and board_id='$board_id' ";
    $result = mysqli_query($connect, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output[] = $row;
        }
        echo json_encode($output);
}}
?> 