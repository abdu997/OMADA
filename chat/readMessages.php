<?php
include("../php/connect.php");
$output = [];
session_start();
$user_id = $_SESSION['user_id'];
$team_id = $_SESSION['team_id'];
if (isset($_GET['chatroom_id'])) {
    $chatroom_id   = $_GET['chatroom_id'];
    $sql = "SELECT * FROM messages WHERE chatroom_id = '$chatroom_id'";
    $result = mysqli_query($connect, $sql);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $status = '';
            if($user_id == $row[3]){
                $row[2] = 'smessage';
                $status = 'sender';
            }
            elseif($user_id != $row[3]){
                $row[2] = 'rmessage';
                $status = 'receiver';
            }
            
            $sql2 = "SELECT first_name, last_name FROM users WHERE user_id = '$row[3]'";
            $row2 = mysqli_fetch_array(mysqli_query($connect,$sql2));
            $name = $row2[0].' '.$row2[1];
            $out = array(
                'message_id' => $row[0], 
                'chatroom_id' => $row[1],
                'class' => $row[2],
                'status' => $status,
                'sender' => $name,
                'timestamp' => $row[4],
                'message' => $row[5],
                'initial_message'=> $row[6],
            );
            $output[] = $out;
                
        }
        echo json_encode($output);
    }
    
    
}
?>  