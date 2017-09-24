<?php
/*DASHBOARD*/
ini_set('display_errors', 1); 
error_reporting(E_ALL);

/*Including connection to the database file and Mail package*/
include "../connection/connect.php";
require_once "../lib/pear/Mail.php";
require_once "../lib/random.php";


/*Creating token which expires in 24 hours*/
$length = 72;
$token = bin2hex(random_bytes($length));
$hashed_token = password_hash($token, PASSWORD_DEFAULT);

/*Checking if email is set and then assigning to $email variable*/
if(isset($_POST['email'])){
$email = $_POST['email'];
}





/*SQL command to insert token and email into the reset table*/
$sql = "INSERT INTO `user_reset` (token,email) VALUES ('$hashed_token', '$email')";
mysqli_query($conn, $sql);


/*Initiailizing all parameters needed to send e-mail*/
$from = '<reset@dashboard.ca>';
$to = '<'.$email.'>';
$subject = 'Password Reset';
$msg = "Please follow the link to reset your password.\nIf you haven't requested this change, please ignore this email.\n Link: localhost/Dashboard/reset.php?token=$token ";
$message = wordwrap($msg, 70, "\n");

$headers = array(
    'From' => $from,
    'To' => $to,
    'Subject' => $subject
);

if(mail($to, $subject, $message, $headers)){
    echo("success");
       }
else{
    echo("fail");
}

/*$smtp = Mail::factory('smtp', array(
        'host' => 'mail.commissionaires.ca',
		'port' => '587',
		'auth' => true,	
		'username' => 'reset@commissionaires.ca',
		'password'=> 'reset0719pw'
		
    ));*/






/*$mail = $smtp->send($to, $headers, $message);*/












?>