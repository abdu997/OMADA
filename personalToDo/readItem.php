<?php 
include "../php/connect.php";
session_start();
$user_id = $_SESSION['user_id'];
$output = array();
$sql = "SELECT task_id, task, progress, timestamp FROM personal_todo WHERE user_id = '$user_id' AND status = 'valid'";
$result = mysqli_query($connect, $sql);
while($row = mysqli_fetch_array($result)){
    $output[] = $row;
}
echo json_encode($output);
?>