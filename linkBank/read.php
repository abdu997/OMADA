<?php
include("../php/connect.php");
session_start();
$output = array();
$team_id = $_SESSION['team_id'];
$sql  = "SELECT record_id, user_id, link, note, timestamp FROM link_bank WHERE team_id = '$team_id' AND status = 'valid'";
$result = mysqli_query($connect, $sql);
function make_links_clickable($text){
    return preg_replace('!(((f|ht)tp(s)?://)[-a-zA-Zа-яА-Я()0-9@:%_+.~#?&;/=]+)!i', "<a target='_blank' style='text-decoration: underline' href='$1'>$1</a>", $text);}
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $user_id = $row["user_id"];
        $sql2 = "SELECT first_name,last_name FROM users WHERE user_id = '$user_id'";
        $result2 = mysqli_query($connect,$sql2);
        $row2 = mysqli_fetch_array($result2);
        $row["user"] = $row2[0].' '.$row2[1];
            
        $text = $row["link"];
        $link = make_links_clickable($text);
        $row["url"] = $link;
        $output[] = $row;
        
    }
    echo json_encode($output);
}
?> 
