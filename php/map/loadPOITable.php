<?php
  session_start();
  include "../connection.php";

  $user_id = $_SESSION['user_id'];
  $team_id = $_SESSION['team_id'];

  if (isset($_GET) && isset($_GET['type'])){
    if ($_GET['type'] == 'team'){
      $typing = True;
      $poi_sql = "SELECT * FROM `test`.`map` WHERE `team_id` = $team_id or `user_id` = $user_id ORDER BY `id`";
    } else {
      $poi_sql = "SELECT * FROM `test`.`map` WHERE `user_id` = $user_id ORDER BY `id`";
      $typing = False;
    }

    $poi_result = mysqli_query($conn, $poi_sql);

    if ($poi_result){
      echo "<div id=\"POITableWrap\">";
      //classes: table table-striped table-bordered dt-responsive nowrap
      echo "<table id=\"POITable\" class=\"table table-striped table-bordered dt-responsive break-word\" cellspacing=\"0\" style=\"max-width:50%\">";
      echo "<thead>";
      echo "<tr>";
      echo "<th >ID #</th>";
      if ($typing){
        echo "<th >Type</th>";
      }
      echo "<th >Name</th>";
      echo "<th >Address</th>";
      echo "<th >Phone #</th>";
      echo "<th >Website</th>";
      echo "<th >Description</th>";
      echo "<th >Colour</th>";
      echo "<th >Latitude</th>";
      echo "<th >Longitude</th>";
      echo "</tr>";
      echo "</thead>";
      echo "<tbody>";

      $id_counter = 0;
      $team_counter = 0;
      $user_counter = 0;
      $marker_type = "";
      while ($row = mysqli_fetch_assoc($poi_result)){
        $id_show = $id_counter + 1;
        echo "<tr>";
        echo "<td>$id_show</td>";
        if ($typing){
          if($row['team_id']){
            echo "<td>Team</td>";
            echo "<td><a onclick=\"find_marker($team_counter, 'team')\">". $row['name'] . "</a></td>";
            $team_counter = $team_counter + 1;
          } else {
            echo "<td>Personal</td>";
            echo "<td><a onclick=\"find_marker($user_counter, 'user_in_team')\">". $row['name'] . "</a></td>";
            $user_counter = $user_counter + 1;
          }
        } else {
          echo "<td><a onclick=\"find_marker($id_counter, 'user')\">". $row['name'] . "</a></td>";
        }
        $id_counter = $id_counter + 1;
        echo "<td>". $row['address'] . "</td>";
        echo "<td>". $row['phone'] . "</td>";

        $site_prefix = 'http://';
        $website = $row['website'];
        if (isset($row['website']) && substr($row['website'], 0, 7) == 'http://'){
          $website = substr($row['website'], 7);
        } elseif (isset($row['website']) && substr($row['website'], 0, 8) == 'https://'){
          $site_prefix = 'https://';
          $website = substr($row['website'], 8);
        }
        echo "<td><a href=\"" . $site_prefix . $website . "\" target='_blank'>". $row['website'] . "</a></td>";
        echo "<td>". $row['description'] . "</td>";
        echo "<td>". $row['colour'] . "</td>";
        echo "<td>". $row['lat'] . "</td>";
        echo "<td>". $row['lng'] . "</td>";
        echo "</tr>";
      }
      echo "</tbody>";
      echo "</table>";
      echo "</div>";
    } else {
      echo 'error with sql';
    }

  } else {
    echo 'error with parameters';
  }

?>
