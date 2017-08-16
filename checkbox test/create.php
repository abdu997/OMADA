<?php
error_reporting( E_ALL );
include("connect.php");
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
                
                $sql = "SELECT idusers FROM users WHERE concat_ws(' ',first_name,last_name) LIKE '$x'";
                $res = mysqli_query($connect,$sql);
                $row = mysqli_fetch_array($res);
                $id = $row[0];
                
                $sql2 = "INSERT INTO chatroom_user (chatroom_id, user_id) VALUES('$chat_id', '$id')";
                mysqli_query($connect, $sql2);
            }
        } else {
            echo 'Error';
        }
        
        
       
    }
    if ($btn_name == 'Edit') {
        $id    = $data->id;
        $query = "UPDATE linkRepository SET link = '$link', note = '$note' WHERE id = '$id'";
        if (mysqli_query($connect, $query)) {
            echo 'Data Updated...';
        } else {
            echo 'Error';
        }
    }
}
else{
    echo "Empty Data";
}
?>  