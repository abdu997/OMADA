<?php
include("connect.php");
$output = [];
if (isset($_GET['chatroom_id'])) {
    $chatroom_id   = $_GET['chatroom_id'];
    $query = "SELECT * FROM messages WHERE chatroom_id = '$chatroom_id'";
    $result = mysqli_query($connect, $query);
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
            
            $sql = "SELECT first_name, last_name FROM users WHERE idusers = '$row[3]'";
            $rows = mysqli_fetch_array(mysqli_query($connect,$sql));
            $name = $rows[0].' '.$rows[1];
            $out = array(
                'message_id' => $row[0], 
                'chatroom_id' => $row[1],
                'class' => $row[2],
                'status' => $status,
                'sender' => $name,
                'timestamp' => $row[4],
                'message' => $row[5]
            );
            $output[] = $out;
                
        }
        echo json_encode($output);
    }
    
    
}
?>  