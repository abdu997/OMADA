<?php
session_start();
include "connection.php";
if(!isset($_POST['teamname'])){
    echo "fail";
}
else{
     $tname = $_POST['teamname'];
    $teamname = mysqli_real_escape_string($conn,$tname);
}

$email_array = array();
if(!empty($_POST['email1'])){
    array_push($email_array, $_POST['email1']);
}
if(!empty($_POST['email2'])){
    array_push($email_array, $_POST['email2']);
}
if(!empty($_POST['email3'])){
    array_push($email_array, $_POST['email3']);
}
if(!empty($_POST['email4'])){
    array_push($email_array, $_POST['email4']);
}

$sql = "INSERT INTO `team` (team_name) VALUES ('$teamname') ";
if(mysqli_query($conn, $sql)){
    $sql = "SELECT team_id FROM `team` WHERE team_name = '$teamname'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $tid = $row['team_id'];
}
$uid = $_SESSION['user_id'];
$sql = "INSERT INTO `team_user` (t_id, u_id, admin) VALUES ('$tid','$uid','Y')";
mysqli_query($conn, $sql);

//echo "success";



for ($i = 0; $i < count($email_array); $i++){
    $email = mysqli_real_escape_string($email_array[$i]);
    $sql = "SELECT iduser, email FROM `user` WHERE email = '$email_array[$i]'";
    if(mysqli_num_rows($conn, $sql) == 1){
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $uid = $row['iduser'];
        $sql = "INSERT INTO `team_user` (t_id, u_id, admin) VALUES ('$tid','$uid','N')";
    }
    else{
         $sql = "INSERT INTO `confirmation_users` (email) VALUES ('$email')";
    }
    
    mysqli_query($conn, $sql);
}


?>