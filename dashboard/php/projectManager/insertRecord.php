<?php
include("../connect.php");
session_start();
$user_id = $_SESSION['user_id'];
$team_id = $_SESSION['team_id'];
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0) {
    $record = mysqli_real_escape_string($connect, $data->record);
    $goal_id = $data->goal_id;
    $board_id = $data->board_id;
    if ($goal_id == 0){
        echo "Error: goal_id invalid";
    } else {
        $query = "INSERT INTO progress_record(user_id, team_id, goal_id, board_id, record, initial_record, timestamp) VALUES ('$user_id', '$team_id', '$goal_id', '$board_id', '$record', 'N', '$timestamp')";
        if (mysqli_query($connect, $query)) {
            echo "Record Entered";
        } else {
            echo 'Error';
        }
    }
}
?>  