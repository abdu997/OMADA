<?php
include("connect.php");

$data = json_decode(file_get_contents("php://input"));

if (count($data) > 0) {
    $message = mysqli_real_escape_string($connect, $data->message);
    $chatroom_id   = $data->chatroom_id;
    
        $query = "INSERT INTO messages (chatroom_id, class, sender, message) VALUES ('$chatroom_id', 'smessage', '$user_id', '$message')";
        if (mysqli_query($connect, $query)) {
            echo "Message Sent...";
        } else {
            echo 'Error';
        }
}
?>  