<?php 
require_once '../php/connect.php'; // The mysql database connection script
if(isset($_GET['item'])){
	$item = $connect->real_escape_string($_GET['item']);
	$status = "0";
	$created = date("Y-m-d", strtotime("now"));

	$query="INSERT INTO personal_todo(user_id,item,status,created_at)  VALUES ('$user_id', '$item', '$status', '$created')";
	$result = $connect->query($query) or die($connect->error.__LINE__);

	$result = $connect->affected_rows;

	echo $json_response = json_encode($result);
	}
?>