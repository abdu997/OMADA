<?php
include("../php/connect.php");
session_start();
$user_id = $_SESSION['user_id'];
$team_id = $_SESSION['team_id'];
$data = json_decode(file_get_contents("php://input"));

if (count($data) > 0) {
    $message = mysqli_real_escape_string($connect, $data->message);
    $chatroom_id   = $data->chatroom_id;
    
    if($chatroom_id == 0){
        echo "Error: Invalid chatroom_id";
    } else {
        $query = "INSERT INTO messages (chatroom_id, class, sender, timestamp, message, initial_message) VALUES ('$chatroom_id', 'smessage', '$user_id', '$timestamp', '$message', 'N')";
        if (mysqli_query($connect, $query)) {
            echo "Message Sent...";
        } else {
            echo 'Error';
        }
    }
}
?>  