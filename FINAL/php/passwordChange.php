<?php
include "connect.php";
include "session.php";
$data = json_decode(file_get_contents("php://input"));

if(count($data) > 0){
	$passHash = password_hash($data->new_password, PASSWORD_DEFAULT);
    $new_password = mysqli_real_escape_string($connect, $passHash); 
    $query = "UPDATE users SET password = '$new_password' WHERE idusers='$user_id'"; 
    if(mysqli_query($connect, $query)) {
        echo "success";
    } else {
        echo "error";
    }
}
	
?>