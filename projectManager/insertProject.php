<?php
include("../php/connect.php");
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0) {
    $project = mysqli_real_escape_string($connect, $data->project);
    $tag_color = $data->tag_color;

    $query = "INSERT INTO team_projects(team_id, project, tag_color) VALUES ('$team_id', '$project', '$tag_color')";
    if (mysqli_query($connect, $query)) {
        echo "Project Entered";
    } else {
        echo 'Error';
    }
}
?>  