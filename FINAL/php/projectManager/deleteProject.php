<?php
include("../connect.php");
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0) {
    $project_id = $data->project_id;
    $query = "DELETE FROM team_projects WHERE project_id='$project_id'";
    if (mysqli_query($connect, $query)) {
        $query2 = "DELETE FROM team_goal WHERE project_id = '$project_id'";
        mysqli_query($connect, $query2);
        echo "success";
    } if(mysqli_query($connect, $query2)){
        $query3 = "DELETE FROM progress_record WHERE project_id='$project_id'";
        mysqli_query($connect, $query3);
    }
    else {
        echo 'Error';
    }
}
 
?>