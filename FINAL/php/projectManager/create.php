<?php
include("../connect.php");
session_start();
$user_id = $_SESSION['user_id'];
$team_id = $_SESSION['team_id'];
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0) {
    $goal = mysqli_real_escape_string($connect, $data->goal);
    $project_id   = $data->project_id;
    $status = "not_started";
    $btn_name   = $data->btnName;

    if ($btn_name == "ADD") {
        if ($project_id == 0) {
            echo "Error: project_id invalid";
        } else {
            $query = "INSERT INTO team_goal(project_id, team_id, status, goal) VALUES ('$project_id', '$team_id', '$status','$goal')";
        }

        if (mysqli_query($connect, $query)) {
            $goal_id = mysqli_insert_id($connect);

            $query2 = "INSERT INTO progress_record(user_id, team_id, goal_id, project_id, record, initial_record, timestamp) VALUES ('$user_id', '$team_id', '$goal_id', '$project_id', '$goal created by', 'Y', '$timestamp')";
            mysqli_query($connect, $query2);
        } else {
            echo 'Error';
        }
    }
    if ($btn_name == 'Update') {
        $goal_id = $data->goal_id;
        $project_id = $data->project_id;
        $query = "UPDATE team_goal SET goal = '$goal' WHERE goal_id = '$goal_id'";
        $query2 = "INSERT INTO progress_record(user_id, team_id, goal_id, project_id, record, initial_record, timestamp) VALUES ('$user_id', '$team_id', '$goal_id', '$project_id', 'Goal name changed to $goal', 'N', '$timestamp')";
        mysqli_query($connect, $query2);
        if (mysqli_query($connect, $query)) {
            echo 'Data Updated...';
        } else {
            echo 'Error';
        }
    }
}
?>
