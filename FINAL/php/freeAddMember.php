<?php
include'connect.php';
session_start();
$data = json_decode(file_get_contents("php://input"));
$team_id = $_SESSION['team_id'];
$team_type = $_SESSION['team_type'];
$plan = $_SESSION['plan'];
$email = mysqli_real_escape_string($connect, $data->email);
$admin = mysqli_real_escape_string($connect, $data->admin);
if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    if(count($data)>0){
        if($team_type == 'personal'){
            echo "Adding members to personal dashboard's is not permissible";
        } else if($plan == 'free'){
            $sql6 = "SELECT * FROM team_user WHERE t_id = '$team_id'";
            $result6 = mysqli_query($connect, $sql6);
            $count6 = mysqli_num_rows($result6);
            $sql7 = "SELECT * FROM team_nonuser WHERE team_id = '$team_id'";
            $result7 = mysqli_query($connect, $sql7);
            $count7 = mysqli_num_rows($result7);
            $member_count = $count6+$count7;
            if($member_count < 6){
                //check if email is in use in users table
                $sql = "SELECT idusers FROM users WHERE email = '$email'";
                $result = mysqli_query($connect, $sql);
                $count = mysqli_num_rows($result);
                if($count == 1){
                    //query the user's user_id from 'users'
                    $row = mysqli_fetch_assoc($result);
                    $user_id = $row['idusers'];
                    //check if user_id and team_id are in a record at 'team_user' 
                    $sql2 = "SELECT u_id, t_id FROM team_user WHERE u_id = '$user_id' AND t_id = '$team_id'";
                    $result2 = mysqli_query($connect, $sql2);
                    $count2 = mysqli_num_rows($result2);
                    if($count2 == 1){
                        //user is already in this team
                        echo "This user is already in this team";
                    } else if($count2 == 0) {            
                        //user is not in team, create connection
                        //Admin status will always be 'N' with the free plan for new members, to change admin user can use change Admin
                        $sql3 = "INSERT INTO team_user(t_id, u_id, admin) VALUE('$team_id', '$user_id', 'N')";
                        if(mysqli_query($connect, $sql3)){
                            echo "success";
                        } else {
                            echo "serious error3";
                        }
                    } else {
                        echo "serious error2";
                    }
                } else if($count == 0) {
                    //check if email is already in team_nonuser
                    $sql4 = "SELECT email, team_id FROM team_nonuser WHERE email = '$email' AND team_id = '$team_id'";
                    $result4 = mysqli_query($connect, $sql4);
                    $count4 = mysqli_num_rows($result4);
                    if($count4 == 0){
                        $sql5 = "INSERT INTO team_nonuser(email, team_id, admin, status) VALUE('$email', '$team_id', 'N', 'pending')";
                        if(mysqli_query($connect, $sql5)){
                            echo"An invitation has been sent to ".$email.", please advise your member to register to OmadaHQ";
                        } else {
                            echo"serious error3";
                        }
                    } else if($count4 > 0){
                        echo"This email is already a member in this team";
                    }

                } else {
                    echo "serious error4";
                }
            } else {
                echo"too many members";
            }
        } else {
            echo"serious error 5";
        }
    }   
} else {
    echo "This email is not valid";
}
?>