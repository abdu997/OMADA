<?php
session_start();
$user_id = $_SESSION['user_id'];
$team_id = $_SESSION['team_id'];
echo $team_id;
?>