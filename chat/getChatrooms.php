<?php
include("connect.php");
$output = [];

$query = "SELECT chatroom_id FROM chatroom_user WHERE user_id = '$user_id' AND team_id = '$team_id'";
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
        $chatroom_id = $row[0];
        $sql = "SELECT chatroom_name FROM chatrooms WHERE chatroom_id = '$chatroom_id'";
        $res = mysqli_query($connect, $sql);
        $rows = mysqli_fetch_array($res);
        $out = array(
                'chatroom_id' => $chatroom_id,
                'chatroom_name' => $rows[0]
            );
            $output[] = $out;
                
        }
        echo json_encode($output);
    }
    
    

?>  