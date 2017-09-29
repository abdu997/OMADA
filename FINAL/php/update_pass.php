<?php
include "connect.php";
//include "session.php";
$data = json_decode(file_get_contents("php://input"));

if(count($data) > 0){
	$passHash = password_hash($data->password, PASSWORD_DEFAULT);
    $mypassword = mysqli_real_escape_string($connect, $passHash); 
	$sql = "UPDATE `users` SET password = '$mypassword' WHERE idusers = '$data->user_id'";
    if(mysqli_query($connect, $sql)){
        $sql2 = "INSERT INTO team (team_name, type) VALUES('Personal Dashboard', 'personal')";
        if (mysqli_query($connect, $sql2)){
            $team_id = mysqli_insert_id($connect);
            $sql3 = "INSERT INTO team_user (t_id, u_id, admin) VALUES('$team_id', '$data->user_id', 'Y')";
            mysqli_query($connect, $sql3);
        } else {
            $return  = "Success";
            echo $return;
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
    }
}	
?>