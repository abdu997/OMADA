<?php
  session_start();
  include "../connection.php";

  $user_id = $_SESSION['user_id'];
  $team_id = $_SESSION['team_id'];

  $icon_url = "http://maps.google.com/mapfiles/ms/micons/";

  if ($_GET['type'] == 'team'){
    $poi_sql = "SELECT * FROM `test`.`map` WHERE `team_id` = $team_id ORDER BY `id`";
  } else {
    $poi_sql = "SELECT * FROM `test`.`map` WHERE `user_id` = $user_id ORDER BY `id`";
  }

  $points = mysqli_query($conn, $poi_sql);

  if ($points->num_rows > 0){
    $arr = [];
    $inc = 0;
    while ($row = mysqli_fetch_assoc($points)){
      $db_id = $row['id'];
      if ($row['name']){
        $name = $row['name'];
      } else {
        $name = NULL;
      }
      if ($row['address']){
        $address = $row['address'];
      } else {
        $address = NULL;
      }
      if ($row['phone']){
        $phone = $row['phone'];
      } else {
        $phone = NULL;
      }
      if ($row['website']){
        $website = $row['website'];
      } else {
        $website = NULL;
      }
      if ($row['description']){
        $description = $row['description'];
      } else {
        $description= NULL;
      }
      $colour = $row['colour'];
      $lat = $row['lat'];
      $lng = $row['lng'];

      if ($_GET['type'] == 'user_in_team'){
        $url = $icon_url . strtolower($colour) . '.png';
      } else {
        $url = $icon_url . strtolower($colour) . '-dot.png';
      }

      $point = (array('name' => $name,
                      'address' => $address,
                      'phone' => $phone,
                      'website' => $website,
                      'description' => $description,
                      'colour' => $colour,
                      'lat' => $lat,
                      'lng' => $lng,
                      'url' => $url,
                      'id' => $inc,
                      'db_id' => $db_id));
      $arr[$inc] = $point;
      $inc++;
    }
  } else {
    $arr = [];
  }

  echo json_encode($arr);

?>
