<?php
$connect = mysqli_connect("localhost", "root", "", "test");
session_start();
$team_id = $_SESSION['team_id'];
$user_id = $_SESSION['user_id'];;
date_default_timezone_set('US/Eastern');
$date = date("Y-m-d", strtotime("now"));
$time = date("H:i:s", strtotime("now"));
$timestamp = $date . 'T' . $time . '-04:00';
?>