<?php
include 'connect.php';
session_start();
$data = json_decode(file_get_contents('php://input'));
$admin_status = $_SESSION['admin_status'];
$team_type = $_SESSION['team_type'];
if(count($data) > 0){
    $team_id = $data->team_id;
    $team_name = mysqli_real_escape_string($connect, $data->team_name);
    if($team_type == 'team'){
        if($admin_status == 'Y'){
            $sql = "UPDATE team SET team_name = '$team_name' WHERE team_id = '$team_id'";
            if(mysqli_query($connect, $sql)) {
                echo'success';
            } else {
                echo'phperror';
            }   
        } else {
            echo'Nice try, but no.';
        }
    } else {
        echo'Nice try, but no.';
    }
}
?>