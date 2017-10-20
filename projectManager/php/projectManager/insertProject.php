<?php
include("../connect.php");
session_start();
$user_id = $_SESSION['user_id'];
$team_id = $_SESSION['team_id'];
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0) {
    $project = mysqli_real_escape_string($connect, $data->project);
//    $tag_color = $data->tag_color;

    $query = "INSERT INTO team_projects(team_id, project) VALUES ('$team_id', '$project')";
    if (mysqli_query($connect, $query)) {
        echo "Project Entered";
    } else {
        echo 'Error';
    }
}
?>  