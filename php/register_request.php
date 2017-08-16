<?php
include "connection.php";
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$fname = mysqli_real_escape_string($conn, $_POST['fname']);
$lname = mysqli_real_escape_string($conn, $_POST['lname']);
$hashed_pass = password_hash($password, PASSWORD_DEFAULT); 
$sql = "INSERT INTO test.users (username,email,password ,first_name, last_name)
VALUES ('ybce','$email', '$hashed_pass', '$fname', '$lname')";
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>