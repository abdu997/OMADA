<?php 
include "../connect.php";
session_start();
$user_id = $_SESSION['user_id'];
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
    $task_id = mysqli_real_escape_string($connect, $data->task_id);
    $sql = "SELECT progress FROM personal_todo WHERE user_id = '$user_id' AND task_id = '$task_id'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);
    if($count = 1){
        if($row[0] == "complete"){
            $progress = "incomplete";
        } else {
            $progress = "complete";
        }
        $sql2 = "UPDATE personal_todo SET progress = '$progress' WHERE  user_id = '$user_id' AND task_id = '$task_id'";
        
        if(mysqli_query($connect, $sql2)){
            echo "success";
        } else {
            echo "error";
        }
    }
}
?>