<?php 
include("../connect.php");
session_start();
$user_id = $_SESSION['user_id'];
$team_id = $_SESSION['team_id'];
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $status = mysqli_real_escape_string($connect,$data->status);
    if($status == "inProgress" || $status == "inReview" || $status == "completed" || $status == "not_started"){
        $goal_id = mysqli_real_escape_string($connect, $data->goal_id);
        $query="UPDATE team_goal set status = '$status' where goal_id = '$goal_id'";
        if(mysqli_query($connect, $query)){
            echo "Status update successful";    
        }
    } else {
        echo'invalid status';
    }
} else {
    echo "Error Occured";
}
?>