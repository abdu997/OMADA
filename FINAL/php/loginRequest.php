
<?php

ini_set('display_errors', 1); 
error_reporting(E_ALL);
//echo 'Current PHP version: ' . phpversion();
//require_once('../lib/password.php');

include "connect.php";
	
//	if(isset($_POST['email']) && isset($_POST['password'])){
//		$email = $_POST['email'];
//		$pass = $_POST['password'];
//	}

$data = json_decode(file_get_contents("php://input"));

if (count($data) > 0) {
	  $myemail = mysqli_real_escape_string($connect, $data->email);
      $mypassword = mysqli_real_escape_string($connect, $data->password); 

	

	$sql = "SELECT idusers, username, password,first_name FROM `test`.`users` WHERE email = '$myemail'";
	$result = mysqli_query($connect, $sql);
	$count = mysqli_num_rows($result);
	$row = $result -> fetch_row();


	

	if($count == 1){
		$bool = password_verify($mypassword, $row[2]);
		if($bool == true){
			$_SESSION['user'] = $myemail;
            $_SESSION['user_id'] = $row[0];
            $_SESSION['name'] = $row[3];
			$return = 'login as ';
		 
		}
		else{
			$return = 'fail';
		
		}
		
	}
	else{
		$return = 'fail';
		
		
	}

echo $return.$_SESSION['name'];

}
	

?>