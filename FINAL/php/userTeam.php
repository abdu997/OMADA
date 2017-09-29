<?php
include("connect.php");
session_start();
$user_id = $_SESSION['user_id'];
$output = array();
$query  = "SELECT * FROM team_user WHERE u_id='$user_id' ";
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $t_id = $row[0];
        $sql = "SELECT team_id, team_name, type FROM team WHERE team_id = '$t_id'";
        $rows = mysqli_fetch_array(mysqli_query($connect,$sql));
        $team_name = $rows[0];     
        $out = array('0' => '0', 'team_id' => $rows[0], 'team_name' => $rows[1]);
        $output[] = $out;  
    }
    echo json_encode($output);
}
?> 