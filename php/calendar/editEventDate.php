<?php
session_start();
include dirname(__FILE__)."../../connection.php";

$user_id = $_SESSION['user_id'];
$team_id = $_SESSION['team_id'];

if (isset($_POST)){

    if (isset($_POST['id']) && (trim($_POST['id']) !== "")){
      $id = $_POST['id'];
    } else {
      $id = NULL;
    }

    if (isset($_POST['all_day']) && ($_POST['all_day'] == "true")){
      $all_day = '1';
    } else {
      $all_day = '0';
    }

    if (isset($_POST['start_time']) && (trim($_POST['start_time']) !== "")){
      $start_time = '\'' . addslashes($_POST['start_time']) . '\'';
    } else {
      $start_time = 'NULL';
    }

    if (isset($_POST['start_date']) && (trim($_POST['start_date']) !== "")){
      $start_date = '\'' . addslashes($_POST['start_date']) . '\'';
    } else {
      $start_date = 'NULL';
    }

    if (isset($_POST['end_time']) && (trim($_POST['end_time']) !== "")){
      $end_time = '\'' . addslashes($_POST['end_time']) . '\'';
    } else {
      $end_time = 'NULL';
    }

    if (isset($_POST['end_date']) && (trim($_POST['end_date']) !== "")){
      $end_date = '\'' . addslashes($_POST['end_date']) . '\'';
    } else {
      $end_date = 'NULL';
    }
    if ($id != NULL){
      $sql = ("UPDATE `test`.`calendar` SET `all_day`=$all_day, "
              . "`start_date`=$start_date, `start_time`=$start_time, "
              . "`end_date`=$end_date, `end_time`=$end_time "
              . "WHERE `id`=$id");
      mysqli_query($conn, $sql);
    }
  }
?>
