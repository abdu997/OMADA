<?php


include "../connection/connect.php";

session_start();
	
	if(isset($_POST['password']) && isset($_POST['email'])){
		
		$pass = $_POST['password'];
		$email = $_POST['email'];
	}
	
/*echo $pass;
echo $email;*/

$passHash = password_hash($pass, PASSWORD_DEFAULT);

	  $email = mysqli_real_escape_string($db, $email);
      $mypassword = mysqli_real_escape_string($db,$passHash); 

	

	$sql = "UPDATE `users` SET password = '$mypassword' WHERE email = '$email'";
	if(mysqli_query($conn, $sql)){
		$return  = "Success";
		echo $return;
	}
else{
	echo "no";
}

	
?>