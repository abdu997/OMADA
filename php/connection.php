<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = 'test';

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Session
$team_id = "1";
$user_id = "1";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";



?>