<?php
session_start();
include dirname(__FILE__)."../../connection.php";

$user_id = $_SESSION['user_id'];
$team_id = $_SESSION['team_id'];

if (isset($_POST)){
    if (isset($_POST['delete']) && ($_POST['delete'] == "true")){
      $delete = true;
    } else {
      $delete = false;
    }

    if (isset($_POST['id']) && (trim($_POST['id']) !== "")){
      $id = $_POST['id'];
    } else {
      $id = NULL;
    }

    if (isset($_POST['event_title']) && (trim($_POST['event_title']) !== "")){
      $event_title = '\'' . $_POST['event_title'] . '\'';
    } else {
      $event_title = 'NULL';
    }

    if (isset($_POST['all_day']) && ($_POST['all_day'] == "true")){
      $all_day = '1';
    } else {
      $all_day = '0';
    }

    if (isset($_POST['start_time']) && (trim($_POST['start_time']) !== "")){
      $start_time = addslashes($_POST['start_time']);
      $start_time = strtotime($start_time);
      $start_time = '\'' . date("H:i:s", $start_time) . '\'';
    } else {
      $start_time = 'NULL';
    }

    if (isset($_POST['start_date']) && (trim($_POST['start_date']) !== "")){
      $start_date = addslashes($_POST['start_date']);
      $start_date = strtotime($start_date);
      $start_date = '\'' . date("Y-m-d", $start_date) . '\'';
    } else {
      $start_date = 'NULL';
    }

    if (isset($_POST['end_time']) && (trim($_POST['end_time']) !== "")){
      $end_time = addslashes($_POST['end_time']);
      $end_time = strtotime($end_time);
      $end_time = '\'' . date("H:i:s", $end_time) . '\'';
    } else {
      $end_time = 'NULL';
    }

    if (isset($_POST['end_date']) && (trim($_POST['end_date']) !== "")){
      $end_date = addslashes($_POST['end_date']);
      $end_date = strtotime($end_date);
      $end_date = '\'' . date("Y-m-d", $end_date) . '\'';
    } else {
      $end_date = 'NULL';
    }

    if (isset($_POST['colour']) && (trim($_POST['colour']) !== "")){
      $colour = '\'' . $_POST['colour'] . '\'';
    } else {
      $colour = 'NULL';
    }
    if (isset($_POST['event_url']) && (trim($_POST['event_url']) !== "")){
      $url = '\'' . $_POST['event_url'] . '\'';
    } else {
      $url = 'NULL';
    }

    if($delete == true && $id != NULL){
      $sql = "DELETE FROM `test`.`calendar` WHERE `id`='$id'";
      mysqli_query($conn, $sql);
    }
    elseif ($id != NULL){
      $sql = ("UPDATE `test`.`calendar` SET `event`=$event_title, "
              . "`all_day`=$all_day, `start_date`=$start_date, "
              . "`start_time`=$start_time, `end_date`=$end_date, "
              . "`end_time`=$end_time, `colour`=$colour, `url`=$url "
              . "WHERE `id`=$id");
      mysqli_query($conn, $sql);
    }
  }
?>
