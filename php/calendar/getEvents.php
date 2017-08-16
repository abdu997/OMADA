<?php
  session_start();
  include dirname(__FILE__)."../../connection.php";
  $user_id = $_SESSION['user_id'];
  $team_id = $_SESSION['team_id'];

  if ($_GET['type'] == 'team'){
    $calendar_sql="SELECT * FROM `test`.`calendar` WHERE `team_id` = $team_id";
  } else {
    $calendar_sql="SELECT * FROM `test`.`calendar` WHERE `user_id` = $user_id";
  }

  $events = mysqli_query($conn, $calendar_sql);
  if ($events->num_rows > 0){
    $arr = [];
    $inc = 0;
      while ($row = mysqli_fetch_assoc($events)){
        if ($row['all_day']){
          $start = $row['start_date'];
          $end = $row['end_date'];
          $all_day = true;
        }
        else {
          $start = $row['start_date'] . 'T' . $row['start_time'];
          $end = $row['end_date'] . 'T' . $row['end_time'];
          $all_day = false;
        }

        $start_date = addslashes($row['start_date']);
        $start_date = strtotime($start_date);
        $start_date = date("Y-m-d", $start_date);
        $start_time = addslashes($row['start_time']);
        $start_time = strtotime($start_time);
        $start_time = date("H:i", $start_time);
        $end_date = addslashes($row['end_date']);
        $end_date = strtotime($end_date);
        $end_date = date("Y-m-d", $end_date);
        $end_time = addslashes($row['end_time']);
        $end_time = strtotime($end_time);
        $end_time = date("H:i", $end_time);
        // $colour = 'black'
        if ($_GET['type'] == 'user_in_team'){
            $backgroundColour = $row['colour'];
            $borderColour = '#AAAAAA';
            if ($row['colour'] == 'yellow'){
                $textColour = '#222222';
            } else {
                $textColour = '#EEEEEE';
            }
        } else {
            $backgroundColour = $row['colour'];
            $borderColour = $row['colour'];
            if ($row['colour'] == 'yellow'){
                $textColour = 'black';
            } else {
                $textColour = 'white';
            }

        }

        $event = (array('title' => $row['event'],
                        'start' => $start,
                        'end' => $end,
                        'start_date' => $start_date,
                        'start_time' => $start_time,
                        'end_date' => $end_date,
                        'end_time' => $end_time,
                        'backgroundColor' => $backgroundColour,
                        'borderColor' => $borderColour,
                        'textColor' => $textColour,
                        'all_day' => $all_day,
                        'event_url' => $row['url'],
                        'id' => $row['id'],
                        'user_id' => $row['user_id'],
                        'team_id' => $row['team_id']));
        $arr[$inc] = $event;
        $inc++;
      }
      $json_array = json_encode($arr);
      echo $json_array;
    } else {
      $arr = [];
      echo json_encode($arr);
    }
?>
