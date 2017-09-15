<?php 
require_once '../php/connect.php';
$status = '%';
if(isset($_GET['status'])){
	$status = $connect->real_escape_string($_GET['status']);
}
$query="SELECT TASK_ID, ITEM, STATUS, CREATED_AT from personal_todo where status like '$status' and user_id = '$user_id' order by task_id desc";
$result = $connect->query($query) or die($connect->error.__LINE__);

$arr = array();
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$arr[] = $row;	
	}
}

# JSON-encode the response
echo $json_response = json_encode($arr);
?>