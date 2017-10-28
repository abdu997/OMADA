<?php
include("../connect.php");
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0) {
    $board_id = $data->board_id;
    $query = "DELETE FROM team_boards WHERE board_id='$board_id'";
    if (mysqli_query($connect, $query)) {
        $query2 = "DELETE FROM team_goal WHERE board_id = '$board_id'";
        mysqli_query($connect, $query2);
        echo "success";
    } if(mysqli_query($connect, $query2)){
        $query3 = "DELETE FROM progress_record WHERE board_id='$board_id'";
        mysqli_query($connect, $query3);
    }
    else {
        echo 'Error';
    }
}
 
?>