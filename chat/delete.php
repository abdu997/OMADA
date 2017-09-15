<?php
include("../php/connect.php");
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0) {
    $chatroom_id   = $data->chatroom_id;
    $query = "DELETE FROM chatrooms WHERE chatroom_id='$chatroom_id'";
    if (mysqli_query($connect, $query)){
    $query2 = "DELETE FROM chatroom_user WHERE chatroom_id = '$chatroom_id'";
    $query3 = "DELETE FROM messages WHERE chatroom_id = '$chatroom_id'";
    mysqli_query($connect, $query2);
        mysqli_query($connect, $query3);
        echo 'Data Deleted';
    } else {
        echo 'Error';
    }
}
?>