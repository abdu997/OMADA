<?php
include "connection.php";
session_start();

$tid = $_SESSION['team_id']

if(isset($_POST['chatroomname']){
    $chname = mysqli_real_escape_string($conn, $_POST['chatroomname']);
}
if(isset($_POST['members']){
    $memArray = $_POST['members'];
}
$sql = "INSERT INTO `test`.chatroom (team_id, chatroom_name) VALUES ($tid,'$chanme')";
if(mysqli_query($conn,$sql)){
    $string = "SELECT chatroom_id FROM `test`.chatroom WHERE chatroom_name = '$chname'";
    $result = mysqli_query($conn,$string);
    if(mysqli_num_rows($result) == 1){
        $row = $result -> fetch_row();
        $chid = $row[0];
    }
}
   $memId = array();
   foreach($memArray as $mem){
       $res = mysqli_query($conn, "SELECT idusers FROM `test`.users WHERE username = '$mem' ");
       $row = $res -> fetch_row();
       $id = $row[0];
       $memID.push($id);
   }
   foreach($memId as $mid){
       mysqli_query($conn, "INSERT INTO `test`.chatroom_user (chatroom_id, user_id) VALUES ('$chid', $id)");
       }


?>