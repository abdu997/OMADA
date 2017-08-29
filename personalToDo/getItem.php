<?php 
require_once '../php/connect.php'; // The mysql database connection script
$status = '%';
if(isset($_GET['status'])){
	$status = $mysqli->real_escape_string($_GET['status']);
}
$query="SELECT ID, ITEM, STATUS, CREATED_AT from personal_task where status like '$status' order by id desc";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);

$arr = array();
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		$arr[] = $row;	
	}
}

# JSON-encode the response
echo $json_response = json_encode($arr);
?>