<?php
include("connect.php");
$output = array();
$query  = "SELECT * FROM linkRepository where TEAM_ID = '$team_id'";
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $user_id = $row[2];
        $sql = "SELECT first_name,last_name FROM users WHERE idusers = '$user_id'";
        $res = mysqli_query($connect,$sql);
        $names = mysqli_fetch_array($res);
        $row["user_id"] = $names[0].' '.$names[1];
        
        $output[] = $row;
        
    }
    echo json_encode($output);
}
?> 