<?php 
require_once '../php/connect.php'; // The mysql database connection script
if(isset($_GET['itemID'])){
	$status = $connect->real_escape_string($_GET['status']);
	$itemID = $connect->real_escape_string($_GET['itemID']);

	$query="UPDATE personal_todo set status='$status' where task_id='$itemID'";
	$result = $connect->query($query) or die($connect->error.__LINE__);

	$result = $connect->affected_rows;

	$json_response = json_encode($result);
}
?>