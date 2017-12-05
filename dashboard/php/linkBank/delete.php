<?php
include("../connect.php");
$data = json_decode(file_get_contents("php://input"));
session_start();
$team_id = $_SESSION['team_id'];
if (count($data) > 0) {
    $record_id = mysqli_real_escape_string($connect,$data->record_id);
    $sql = "SELECT * FROM link_bank WHERE team_id = '$team_id' AND record_id = '$record_id'";
    $result = mysqli_query($connect, $sql);
    $count = mysqli_num_rows($result);
    
    if($count = 1){
        $sql2 = "UPDATE link_bank SET status = 'deleted' WHERE team_id = '$team_id' AND record_id = '$record_id'";
        if(mysqli_query($connect, $sql2)){
            echo "success";
        } else {
            echo "error";
        }
    }
}
?>