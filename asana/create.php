<?php
include("../php/connect.php");
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0) {
    $goal = mysqli_real_escape_string($connect, $data->goal);
    $objective = mysqli_real_escape_string($connect, $data->objective);
    $status = "not_started";
    $btn_name   = $data->btnName;
    
    if ($btn_name == "ADD") {
        $query = "INSERT INTO team_goal(team_id, status, goal) VALUES ('$team_id', '$status','$goal')";
        if (mysqli_query($connect, $query)) {            
            $goal_id = mysqli_insert_id($connect);
            
            $query2 = "INSERT INTO progress_record(user_id, team_id, goal_id, record, initial_record, timestamp) VALUES ('$user_id', '$team_id', '$goal_id', '$objective', 'Y', '$timestamp')";
            mysqli_query($connect, $query2);
        } else {
            echo 'Error';
        }
    } 
    if ($btn_name == 'Update') {
        $goal_id = $data->goal_id;
        $query = "UPDATE team_goal SET goal = '$goal' WHERE goal_id = '$goal_id'";
        if (mysqli_query($connect, $query)) {
            echo 'Data Updated...';
        } else {
            echo 'Error';
        }
    }
}
?>  