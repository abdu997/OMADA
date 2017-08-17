<?php
include("connect.php");
$output = [];
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0) {
    $chatroom_id   = $data->chatroom_id;
    $query = "SELECT * FROM messages WHERE chatroom_id = '$chatroom_id'";
    $result = mysqli_query($connect, $query);
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            $out = array(
                'message_id' => $row[0], 
                'chatroom_id' => $row[1],
                'class' => $row[2],
                'sender' => $row[3],
                'timestamp' => $row[4],
                'message' => $row[5]
            );
            $output[] = $out
                
        }
        echo json_encode($output);
    }
    
    
}
?>  