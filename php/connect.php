<?php
$connect = mysqli_connect("localhost", "root", "", "test");
$team_id = "1";
$user_id = "1";
date_default_timezone_set('US/Eastern');
$date = date("Y-m-d", strtotime("now"));
$time = date("H:i:s", strtotime("now"));
$timestamp = $date . 'T' . $time . '-04:00';
?>