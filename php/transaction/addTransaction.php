<?php
session_start();
include "../connection.php";

$user_id = $_SESSION['user_id'];
$team_id = $_SESSION['team_id'];

if (isset($_POST)){//} && !empty($_POST['type']) && !empty($_POST['amount'])){
    if (isset($_POST['type']) && (trim($_POST['type']) !== "")){
      $type = $_POST['type'];
    } else {
      $type = NULL;
    }
    if (isset($_POST['place']) && (trim($_POST['place']) !== "")){
      $place = addslashes($_POST['place']);
    } else {
      $place = NULL;
    }
    if (isset($_POST['description']) && (trim($_POST['description']) !== "")){
      $description = addslashes($_POST['description']);
    } else {
      $description = NULL;
    }
    if (isset($_POST['date']) && (trim($_POST['date']) !== "")){
      $date = $_POST['date'];
    } else {
      $date = NULL;
    }
    if (isset($_POST['amount']) && (trim($_POST['amount']) !== "")){
      $amount = addslashes($_POST['amount']);
    } else {
      $amount = NULL;
    }
    if (is_uploaded_file($_FILES['receipt']['tmp_name'])){
      $target_dir = '..\\..\\uploads\\receipts\\' . ((string) $team_id);
      if (!file_exists($target_dir)){
        mkdir($target_dir, 0777, true);
      }
    $imageFileType = pathinfo(basename($_FILES["receipt"]["name"]),PATHINFO_EXTENSION);
      date_default_timezone_set('America/Toronto');
      $file_name_date = date('Y-m-d-H-i-s');
      $target_file = $target_dir . '\\' . $file_name_date . '.' . $imageFileType;
      $test_target_file = $target_file;
      $counter = 1;
      while (file_exists($test_target_file)){
        $test_target_file = $target_file . '-' . (string)($counter);
      }
      if ($target_file !== $test_target_file){
        $target_file = $test_target_file;
        $file_name = $file_name_date . (string)($counter) . '.' . $imageFileType;
      } else {
        $file_name = $file_name_date . '.' . $imageFileType;
      }
      $receipt = $_FILES['receipt']['tmp_name'];
      if (!move_uploaded_file($receipt, $target_file)){
        $file_name = NULL;
      }
    } else {
        $file_name = NULL;
    }

    if ($type !== NULL){
        $sql = "INSERT INTO `test`.`transaction` (user_id, team_id, type, place, description, date, amount, timestamp, receipt) VALUES ('$user_id', '$team_id', '$type', '$place', '$description', '$date', '$amount', CURRENT_TIMESTAMP, '$file_name')";
        mysqli_query($conn, $sql);
    }


    echo 'uploads\\receipts\\'.$team_id.'\\'.$file_name;
  }
//
//     $trantype = $_POST['type'];
//     $amount = $_POST['amount'];
//     $trantype =  mysqli_real_escape_string($conn, $trantype);
//     $amount =  mysqli_real_escape_string($conn, $amount);
//     $user_id = $_SESSION['user_id'];
//     $team_id = $_SESSION['team_id'];
//
//     if (isset($_POST['place'])){
//         $place = $_POST['place'];
//         $place =  mysqli_real_escape_string($place);
//     } else {
//         $place = NULL;
//     }
//
//     if (isset($_POST['description'])){
//         $description = $_POST['description'];
//         $description =  mysqli_real_escape_string($description);
//     } else {
//         $description = NULL;
//     }
//
//     if (isset($_POST['date'])){
//         $date = $_POST['date'];
//         $date =  mysqli_real_escape_string($date);
//     } else {
//         $date = NULL;
//     }
//
//     $receipt = NULL;
//
//     // if (isset($_POST['receipt'])){
//     //     $receipt = $_POST['receipt'];
//     // } else {
//     //     $receipt = NULL
//     // }
//
//     $sql = "INSERT INTO `test`.`transaction` (user_id, team_id, place, description, amount) VALUES ('$user_id', '$team_id', '$place', '$description', '$amount')";
//
//     mysqli_query($conn, $sql);
//
// } else {
//   echo "fail";
// }

?>
