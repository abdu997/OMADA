<?php
include "connect.php";
$data = json_decode(file_get_contents("php://input"));

if (count($data) > 0){
    $email = mysqli_real_escape_string($connect, $data->email);
//    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $first_name = mysqli_real_escape_string($connect, $data->first_name);
    $last_name = mysqli_real_escape_string($connect, $data->last_name);
//    $hashed_pass = password_hash($password, PASSWORD_DEFAULT); 
    $temp_pass = bin2hex(random_bytes(16));
    $sql = "INSERT INTO test.users (email,password ,first_name, last_name)
    VALUES ('$email', '$temp_pass', '$first_name', '$last_name')";
    /*EMAIL($email, $temp_pass)*/
	/*https://www.omadahq.com/password.php/?token=$temp_pass*/
    if (mysqli_query($connect, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }
}
?>
