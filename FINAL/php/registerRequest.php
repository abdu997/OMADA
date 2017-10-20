<?php
include "connect.php";
$data = json_decode(file_get_contents("php://input"));
$email = mysqli_real_escape_string($connect, $data->email);
$first_name = mysqli_real_escape_string($connect, $data->first_name);
$last_name = mysqli_real_escape_string($connect, $data->last_name);
if (count($data) > 0){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        if(preg_match("/^[a-zA-Z ].{2,}$/",$first_name) && preg_match("/^[a-zA-Z ].{2,}$/",$last_name)){
            $sql = "SELECT email from test.users WHERE email = '$email'";
            $result = mysqli_query($connect,$sql);
            $count = mysqli_num_rows($result);
            if($count == 0){
                $bytes = openssl_random_pseudo_bytes(16);
                $temp_pass = bin2hex($bytes);
                $sql = "INSERT INTO users (email,password ,first_name, last_name) VALUES ('$email', '$temp_pass', '$first_name', '$last_name')";
                /*https://www.omadahq.com/password.php?token=$temp_pass*/
                if (mysqli_query($connect, $sql)) {
                    $user_id = mysqli_insert_id($connect);
                    $sql2 = "INSERT INTO team (team_name, type, plan) VALUES('Personal Dashboard', 'personal', 'free')";

                    $sql4 = "SELECT team_id, admin FROM team_nonuser WHERE email = '$email'";
                    $result4 = mysqli_query($connect, $sql4);
                    $count4 = mysqli_num_rows($result4);
                    if($count4 > 0){
                        while($row4 = mysqli_fetch_array($result4)){
                            $team_id1 = $row4["0"];
                            $admin = $row4["1"];
                            $sql6 = "INSERT INTO team_user(team_id, user_id, admin) VALUE('$team_id1', '$user_id', '$admin')";
                            if(mysqli_query($connect, $sql6)){
                            $sql7 = "UPDATE team_nonuser SET status = 'registered' WHERE email = '$email'";
                            mysqli_query($connect, $sql7);
                            } else {
                                echo"aw hell nah";
                            }
                        }
                    }
                    if (mysqli_query($connect, $sql2)){
                        $team_id = mysqli_insert_id($connect);
                        $sql3 = "INSERT INTO team_user (team_id, user_id, admin) VALUES('$team_id', '$user_id', 'Y')";
                        mysqli_query($connect, $sql3);
                    } else {
                        $return  = "Success";
                        echo $return;
                    }
                    echo "success";
                } else {
                    echo "error1";
                }
            } else {
                echo "error";
            }
        } else {
            echo"Names cannot have numbers or symbols";
        }
    } else {
        echo "email is not valid";
    }
}
?>
