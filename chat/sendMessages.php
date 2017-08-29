<?php
include("../php/connect.php");

$data = json_decode(file_get_contents("php://input"));

if (count($data) > 0) {
    $message = mysqli_real_escape_string($connect, $data->message);
    $chatroom_id   = $data->chatroom_id;
    date_default_timezone_set('US/Eastern');
	$date = date("Y-m-d", strtotime("now"));
	$time = date("H:i:s", strtotime("now"));
    $timestamp = $date . 'T' . $time . 'Z';
    
    
        $query = "INSERT INTO messages (chatroom_id, class, sender, timestamp, message, initial_message) VALUES ('$chatroom_id', 'smessage', '$user_id', '$timestamp', '$message', 'N')";
        if (mysqli_query($connect, $query)) {
            echo "Message Sent...";
        } else {
            echo 'Error';
        }
}
?>  