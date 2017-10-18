<?php
include("connect.php");
include("session.php");
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0) {
    $first_name = mysqli_real_escape_string($connect, $data->first_name);
    $last_name = mysqli_real_escape_string($connect, $data->last_name);
    $email = mysqli_real_escape_string($connect, $data->email);
    
    if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if(preg_match("/^[a-zA-Z ]*$/",$first_name) && preg_match("/^[a-zA-Z ]*$/",$last_name) ){
            $query = "UPDATE users SET email = '$email', first_name = '$first_name', last_name = '$last_name' WHERE idusers = '$user_id'";
            if (mysqli_query($connect, $query)) {
                echo 'Data Updated...';
            } else {
                //This error would occur because email column in MySQL is Unique
                echo 'Email is already being used with another account';
            }    
        } else {
            echo"Names cannot have numbers or symbols";
        }
    } else {
        echo"hell nah";
    }
}
?>  