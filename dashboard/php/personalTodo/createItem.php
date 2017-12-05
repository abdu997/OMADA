<?php 
include "../connect.php";
session_start();
$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"));
$task = mysqli_real_escape_string($connect, $data->task);
if(count($data) > 0 && strlen($task) > 0){
	$progress = "incomplete";
    $status = "valid";
	$sql = "INSERT INTO personal_todo(user_id, task, progress, status, timestamp) VALUES ('$user_id', '$task', '$progress', '$status', '$timestamp')";
    if(mysqli_query($connect, $sql)){
        echo "success";
    } else {
        echo "insert error";
    }
} else {
    echo "task cannot be empty";
}
?>