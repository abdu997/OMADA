<?php
error_reporting( E_ALL );
include("../php/connect.php");
$data = json_decode(file_get_contents("php://input"));

if (count($data) > 0) {
    $chatroom_name = mysqli_real_escape_string($connect, $data->chatroom_name);
    $members = $data -> members;
    
    $btn_name = $data->btnName;
    
    if ($btn_name == "ADD") {
        
        $query = "INSERT INTO chatrooms (team_id,chatroom_name) VALUES ('$team_id', '$chatroom_name')";
        
        if (mysqli_query($connect, $query)) {
            
            $chat_id = mysqli_insert_id($connect);
            
            foreach($members as $x){
                date_default_timezone_set('US/Eastern');
                $date = date("Y-m-d", strtotime("now"));
                $time = date("H:i:s", strtotime("now"));
                $timestamp = $date . 'T' . $time . 'Z';
                
                $sql2 = "INSERT INTO chatroom_user (chatroom_id, user_id, team_id) VALUES('$chat_id', '$x', '$team_id')";
                
                if (mysqli_query($connect, $sql2)) {
                $sql3 = "INSERT INTO messages (chatroom_id, class, sender, message, initial_message) VALUES ('$chat_id', 'smessage', '$user_id', '$chatroom_name', 'Y')";
                mysqli_query($connect,$sql3);
                }
            }
        }
    }
        else {
            echo 'Error';
        }       
    }

else{
    echo "Empty Data";
}
?>  