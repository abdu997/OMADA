<?php
include("connect.php");
$data = json_decode(file_get_contents("php://input"));
if (count($data) > 0) {
    $link = mysqli_real_escape_string($connect, $data->link);
    $note  = mysqli_real_escape_string($connect, $data->note);
    $btn_name   = $data->btnName;
    
    if ($btn_name == "ADD") {
        $query = "INSERT INTO linkRepository(team_id, user_id, link, note) VALUES ('$team_id', '$user_id', '$link', '$note')";
        if (mysqli_query($connect, $query)) {
            echo "Data Inserted...";
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
?>  