<?php 
require_once '../php/connect.php';
if(isset($_GET['itemID'])){
	$itemID = $connect->real_escape_string($_GET['itemID']);

	$query="DELETE FROM personal_todo WHERE task_id = '$itemID'";
	$result = $connect->query($query) or die($connect->error.__LINE__);

	$result = $connect->affected_rows;

	echo $json_response = json_encode($result);
}
?>