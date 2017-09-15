<?php
include("../php/connect.php");
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0) {
    $record = mysqli_real_escape_string($connect, $data->record);
    $goal_id = mysqli_real_escape_string($connect, $data->goal_id);
    $btn_name   = $data->btnName;
    
    if ($btn_name == "ADD") {    
        $query = "INSERT INTO progress_record(user_id, team_id, goal_id, record, initial_record, timestamp) VALUES ('$user_id', '$team_id', '$goal_id', '$record', 'N', '$timestamp')";
    }
    else {
        echo 'Error';
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