<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);
include "connect.php";
$data = json_decode(file_get_contents("php://input"));
session_start();
if (count($data) > 0) {
    $myemail = mysqli_real_escape_string($connect, $data->email);
    $mypassword = mysqli_real_escape_string($connect, $data->password); 
	$sql = "SELECT idusers, password, first_name FROM `test`.`users` WHERE email = '$myemail'";
	$result = mysqli_query($connect, $sql);
	$count = mysqli_num_rows($result);
	$row = $result -> fetch_row();
	if($count == 1){
		$bool = password_verify($mypassword, $row[1]);
		if($bool == true){
			$_SESSION['user'] = $myemail;
            $_SESSION['user_id'] = $row[0];
            $_SESSION['name'] = $row[2];
            $user_id = $_SESSION['user_id']; 
            
            $sql2 = "SELECT min(t_id), admin FROM team_user WHERE u_id = '$user_id'";
            $result2 = mysqli_query($connect, $sql2);
            $row2 = $result2 -> fetch_row();
            $_SESSION['team_id'] = $row2[0];
            $_SESSION['admin_status'] = $row2[1];
            $team_id = $_SESSION['team_id'];
            
            $sql3 = "SELECT team_name, type FROM team WHERE team_id = '$team_id'";
            $result3 = mysqli_query($connect, $sql3);
            $row3 = $result3 -> fetch_row();
            $_SESSION['team_name'] = $row3[0];
            $_SESSION['team_type'] = $row3[1];            
		} else {
            echo "error";
		}	
	}
	else{
		echo "error";
	}

}
?>