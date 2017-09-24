<?php
include "connect.php";
$data = json_decode(file_get_contents("php://input"));

if (count($data) > 0){
    $email = mysqli_real_escape_string($connect, $data->email);
//    $password = mysqli_real_escape_string($connect, $_POST['password']);
//    $fname = mysqli_real_escape_string($connect, $_POST['fname']);
//    $lname = mysqli_real_escape_string($connect, $_POST['lname']);
//    $hashed_pass = password_hash($password, PASSWORD_DEFAULT); 
    $sql = "INSERT INTO test.users (username,email,password ,first_name, last_name)
    VALUES ('ybce','$email', '$hashed_pass', '$fname', '$lname')";
    if (mysqli_query($connect, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }
}
?>