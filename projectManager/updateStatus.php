<?php 
include('../php/connect.php'); // The mysql database connection script
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $status = mysqli_real_escape_string($connect,$data->status);
    $goal_id = mysqli_real_escape_string($connect, $data->goal_id);
    $query="UPDATE team_goal set status = '$status' where goal_id = '$goal_id'";
	if(mysqli_query($connect, $query)){
        echo "Status update successful";    
    }
} else {
    echo "Error Occured";
}
?>