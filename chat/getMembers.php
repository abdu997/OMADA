<?php
include("../php/connect.php");
$output = array();
$query  = "SELECT u_id FROM team_user where t_id = '$team_id'";
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $user_id = $row[0];
        $sql = "SELECT first_name,last_name FROM users WHERE idusers = '$user_id'";
        $res = mysqli_query($connect,$sql);
        $names = mysqli_fetch_array($res);
        $username = $names[0].' '.$names[1];
        $out = array('user_id' => $user_id, 'user_name' => $username);
        $output[] = $out;
        
    }
    echo json_encode($output);
}
?> 