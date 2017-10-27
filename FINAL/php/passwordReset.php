<?php
include "connect.php";
$data = json_decode(file_get_contents("php://input"));
$email = mysqli_real_escape_string($connect, $data->reset_email);
if (count($data) > 0) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $sql = "SELECT user_id, password, first_name FROM users WHERE email = '$email'";
        $result = mysqli_query($connect, $sql);
        $count = mysqli_num_rows($result);
        if($count == 1){
            $row = mysqli_fetch_assoc($result);
            $user_id = $row['user_id'];
            $bytes = openssl_random_pseudo_bytes(40);
            $token = bin2hex($bytes);
            $date_expiration = date("Y-m-d", strtotime("+30 minutes"));
            $time_expiration = date("H:i:s", strtotime("+30 minutes"));
            $expiration = $date_expiration . 'T' . $time_expiration . '-04:00';
            $sql2 = "INSERT INTO password_reset(user_id, user_email, token, timestamp, expiration, status) VALUE('$user_id', '$email', '$token', '$timestamp', '$expiration', 'active')";
            if(mysqli_query($connect, $sql2)) {
                echo "success";
                $link = 'https://www.omadahq.com/dashboard/password.php?token='.$token;
                mail($email, 'OmadaHQ Password Reset link', $link, 'FROM: no-reply@omadahq.com');
            } else {
                echo "error2";
            }
        } else {
            echo "error1";
        }
    } else {
       echo"Email must be valid";
    }
}
?>
