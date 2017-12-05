<?php 
include "../connect.php";
session_start();
$data = json_decode(file_get_contents("php://input"));
$user_id = $_SESSION['user_id'];
if(count($data) > 0){
    $task_id = mysqli_real_escape_string($connect, $data->task_id);
    $sql = "SELECT * FROM personal_todo WHERE user_id = '$user_id' AND task_id = '$task_id'";
    $result = mysqli_query($connect, $sql);
    $count = mysqli_num_rows($result);
    if($count = 1){
        $sql2 = "UPDATE personal_todo SET status = 'deleted' WHERE user_id = '$user_id' AND task_id = '$task_id'";
        if(mysqli_query($connect, $sql2)){
            echo "success";
        } else {
            echo "update error";
        }
    }
}

?>