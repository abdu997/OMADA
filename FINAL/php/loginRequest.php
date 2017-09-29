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
			$return = 'login as ';
            echo $return.$_SESSION['name'];
		} else {
            echo "error";
		}	
	}
	else{
		echo "error";
	}

}
	

?>