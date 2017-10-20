<?php
include'connect.php';
session_start();
$data = json_decode(file_get_contents("php://input"));

if(count($data)>0){
    $old_admin = mysqli_real_escape_string($connect, $data->old_admin_email);
    $new_admin = mysqli_real_escape_string($connect, $data->new_admin_email);
    $sql = "UPDATE team_user WHERE  SET "
}
?>