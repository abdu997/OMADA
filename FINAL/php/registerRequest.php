<?php
include "session.php";
include "connect.php";
$data = json_decode(file_get_contents("php://input"));

if (count($data) > 0){
    $email = mysqli_real_escape_string($connect, $data->email);
	$sql = "SELECT email from test.users WHERE email = '$email'";
	$result = mysqli_query($connect,$sql);
	$count = mysqli_num_rows($result);
	if($count == 0){
//    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $first_name = mysqli_real_escape_string($connect, $data->first_name);
    $last_name = mysqli_real_escape_string($connect, $data->last_name);
//    $hashed_pass = password_hash($password, PASSWORD_DEFAULT); 
    $bytes = openssl_random_pseudo_bytes(16);
    $temp_pass = bin2hex($bytes);
    $sql = "INSERT INTO test.users (email,password ,first_name, last_name)
    VALUES ('$email', '$temp_pass', '$first_name', '$last_name')";
    /*EMAIL($email, $temp_pass)*/
	/*https://www.omadahq.com/password.php/?token=$temp_pass*/
    if (mysqli_query($connect, $sql)) {
        $sql2 = "INSERT INTO team (team_name, type) VALUES('Personal Dashboard', 'personal')";
        if (mysqli_query($connect, $sql2)){
            $team_id = mysqli_insert_id($connect);
            $sql3 = "INSERT INTO team_user (t_id, u_id, admin) VALUES('$team_id', '$data->user_id', 'Y')";
            mysqli_query($connect, $sql3);
        } else {
            $return  = "Success";
            echo $return;
        }
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }
	}
	else{
		echo "error";
	}
}
?>
