<?php
include("../php/connect.php");
session_start();
error_reporting(0);
$user_id = $_SESSION['user_id'];
$team_id = $_SESSION['team_id'];
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0) {
    $link = mysqli_real_escape_string($connect, $data->link);
    $note  = mysqli_real_escape_string($connect, $data->note);
    $btn_name   = $data->btnName;
    
    if(!filter_var($link, FILTER_VALIDATE_URL)){
        die("Link must be a valid URL");
    }
    if(strlen($note) > 0){
        if ($btn_name == "ADD") {
            $sql = "INSERT INTO link_bank(team_id, user_id, link, note, status, timestamp) VALUES ('$team_id', '$user_id', '$link', '$note', 'valid', '$timestamp')";
            if (mysqli_query($connect, $sql)) {
                echo "success";
            } else {
                echo 'Error';
            }
        }
        if ($btn_name == 'Edit') {
            $record_id = mysqli_real_escape_string($connect, $data->record_id);
            $sql2 = "UPDATE link_bank SET link = '$link', note = '$note' WHERE record_id = '$record_id'";
            if (mysqli_query($connect, $sql2)) {
                echo 'success';
            } else {
                echo 'Error';
            }
        }
    } else {
        echo "Note cannot be empty";
    }
}
?>  