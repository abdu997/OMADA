<?php
include("../php/connect.php");
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0) {
    $goal_id    = $data->goal_id;
    $query = "DELETE FROM team_goal WHERE goal_id='$goal_id'";
    if (mysqli_query($connect, $query)) {
        $query2 = "DELETE FROM progress_record WHERE goal_id = '$goal_id'";
        mysqli_query($connect, $query2);
    }
    if (mysqli_query($connect, $query2)) {
        echo "success";
    }
    else {
        echo 'Error';
    }
}
 
?>