
<?php

ini_set('display_errors', 1); 
error_reporting(E_ALL);
//echo 'Current PHP version: ' . phpversion();
//require_once('../lib/password.php');

include "connection.php";
session_start();
	
	if(isset($_POST['email']) && isset($_POST['password'])){
		$email = $_POST['email'];
		$pass = $_POST['password'];
	}

	  $myemail = mysqli_real_escape_string($conn,$_POST['email']);
      $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 

	

	$sql = "SELECT idusers, username, password,first_name FROM `test`.`users` WHERE email = '$myemail'";
	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);
	$row = $result -> fetch_row();


	

	if($count == 1){
		$bool = password_verify($mypassword, $row[2]);
		if($bool == true){
			$_SESSION['user'] = $email;
            $_SESSION['user_id'] = $row[0];
            $_SESSION['name'] = $row[3];
			$return = 'login';
		 
		}
		else{
			$return = 'fail';
		
		}
		
	}
	else{
		$return = 'fail';
		
		
	}

echo $return.$_SESSION['name'];

	

?>